/* =========================================================================
   Lacquer — vanilla JavaScript. No jQuery, no plugins.
   One function per feature, guard clauses, IntersectionObserver,
   honours prefers-reduced-motion.
   ========================================================================= */
(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------------------------------------------------------------------
     Sticky navbar — add solid state on scroll
     --------------------------------------------------------------------- */
  function initStickyNav() {
    var nav = document.querySelector("[data-nav]");
    if (!nav) return;
    var onScroll = function () {
      nav.classList.toggle("is-scrolled", window.scrollY > 40);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  /* ---------------------------------------------------------------------
     Mobile navigation drawer
     --------------------------------------------------------------------- */
  function initMobileNav() {
    var toggle = document.querySelector("[data-nav-toggle]");
    var drawer = document.querySelector("[data-nav-mobile]");
    if (!toggle || !drawer) return;

    var open = function () {
      drawer.classList.add("is-open");
      toggle.setAttribute("aria-expanded", "true");
      document.body.style.overflow = "hidden";
    };
    var close = function () {
      drawer.classList.remove("is-open");
      toggle.setAttribute("aria-expanded", "false");
      document.body.style.overflow = "";
    };

    toggle.addEventListener("click", function () {
      if (drawer.classList.contains("is-open")) { close(); } else { open(); }
    });
    drawer.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", close);
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && drawer.classList.contains("is-open")) { close(); toggle.focus(); }
    });
  }

  /* ---------------------------------------------------------------------
     Scroll reveal via IntersectionObserver
     --------------------------------------------------------------------- */
  function initReveal() {
    var items = document.querySelectorAll(".reveal");
    if (!items.length) return;
    if (reduceMotion || !("IntersectionObserver" in window)) {
      items.forEach(function (el) { el.classList.add("in"); });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("in");
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -8% 0px" });
    items.forEach(function (el) { obs.observe(el); });
  }

  /* ---------------------------------------------------------------------
     Gallery filtering
     --------------------------------------------------------------------- */
  function initGalleryFilter() {
    var container = document.querySelector("[data-gallery]");
    if (!container) return;
    var buttons = container.querySelectorAll("[data-filter]");
    var items = container.querySelectorAll("[data-style]");
    if (!buttons.length || !items.length) return;

    buttons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        var filter = btn.getAttribute("data-filter");
        buttons.forEach(function (b) {
          b.classList.toggle("is-active", b === btn);
          b.setAttribute("aria-pressed", b === btn ? "true" : "false");
        });
        items.forEach(function (item) {
          var match = filter === "all" || item.getAttribute("data-style") === filter;
          item.classList.toggle("is-hidden", !match);
        });
      });
    });
  }

  /* ---------------------------------------------------------------------
     Lightbox for gallery
     --------------------------------------------------------------------- */
  function initLightbox() {
    var triggers = Array.prototype.slice.call(document.querySelectorAll("[data-lightbox]"));
    var box = document.querySelector("[data-lightbox-modal]");
    if (!triggers.length || !box) return;

    var imgEl = box.querySelector("[data-lb-img]");
    var capEl = box.querySelector("[data-lb-cap]");
    var btnClose = box.querySelector("[data-lb-close]");
    var btnPrev = box.querySelector("[data-lb-prev]");
    var btnNext = box.querySelector("[data-lb-next]");
    var current = 0;
    var lastFocus = null;

    function visibleTriggers() {
      return triggers.filter(function (t) { return !t.classList.contains("is-hidden"); });
    }
    function show(index) {
      var list = visibleTriggers();
      if (!list.length) return;
      current = (index + list.length) % list.length;
      var trigger = list[current];
      var full = trigger.getAttribute("data-full") || trigger.querySelector("img").getAttribute("src");
      var cap = trigger.getAttribute("data-caption") || "";
      imgEl.setAttribute("src", full);
      imgEl.setAttribute("alt", cap);
      capEl.textContent = cap;
    }
    function open(trigger) {
      lastFocus = document.activeElement;
      var list = visibleTriggers();
      show(list.indexOf(trigger));
      box.classList.add("is-open");
      box.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
      btnClose.focus();
    }
    function close() {
      box.classList.remove("is-open");
      box.setAttribute("aria-hidden", "true");
      document.body.style.overflow = "";
      if (lastFocus) lastFocus.focus();
    }

    triggers.forEach(function (t) {
      t.addEventListener("click", function (e) { e.preventDefault(); open(t); });
    });
    if (btnClose) btnClose.addEventListener("click", close);
    if (btnPrev) btnPrev.addEventListener("click", function () { show(current - 1); });
    if (btnNext) btnNext.addEventListener("click", function () { show(current + 1); });
    box.addEventListener("click", function (e) { if (e.target === box) close(); });
    document.addEventListener("keydown", function (e) {
      if (!box.classList.contains("is-open")) return;
      if (e.key === "Escape") close();
      if (e.key === "ArrowLeft") show(current - 1);
      if (e.key === "ArrowRight") show(current + 1);
    });
  }

  /* ---------------------------------------------------------------------
     Time-slot chips (booking)
     --------------------------------------------------------------------- */
  function initSlots() {
    var groups = document.querySelectorAll("[data-slots]");
    if (!groups.length) return;
    groups.forEach(function (group) {
      var hidden = group.parentNode.querySelector("[data-slot-value]");
      var slots = group.querySelectorAll("[data-slot]");
      slots.forEach(function (slot) {
        slot.addEventListener("click", function () {
          slots.forEach(function (s) { s.classList.toggle("is-selected", s === slot); });
          if (hidden) hidden.value = slot.getAttribute("data-slot");
          var field = group.closest(".lq-field");
          if (field) field.classList.remove("has-error");
        });
      });
    });
  }

  /* ---------------------------------------------------------------------
     Booking form validation + confirmation
     --------------------------------------------------------------------- */
  function initBookingForm() {
    var form = document.querySelector("[data-booking-form]");
    if (!form) return;
    var success = form.querySelector("[data-booking-success]");

    function setError(field, on) {
      if (!field) return;
      field.classList.toggle("has-error", on);
      var input = field.querySelector("input, select, [data-slot-value]");
      if (input && input.classList) input.classList.toggle("is-invalid", on);
    }

    form.querySelectorAll("input, select").forEach(function (el) {
      el.addEventListener("input", function () {
        var field = el.closest(".lq-field");
        if (field) setError(field, false);
      });
      el.addEventListener("change", function () {
        var field = el.closest(".lq-field");
        if (field) setError(field, false);
      });
    });

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var valid = true;
      var firstBad = null;

      form.querySelectorAll("[data-required]").forEach(function (el) {
        var field = el.closest(".lq-field");
        var value = (el.value || "").trim();
        var bad = !value;
        if (el.type === "email" && value) {
          bad = !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }
        setError(field, bad);
        if (bad) { valid = false; if (!firstBad) firstBad = el; }
      });

      if (!valid) {
        if (firstBad && firstBad.focus) firstBad.focus();
        return;
      }

      var service = form.querySelector("[name='service']");
      var tech = form.querySelector("[name='technician']");
      var date = form.querySelector("[name='date']");
      var time = form.querySelector("[data-slot-value]");
      if (success) {
        var svcText = service && service.options ? service.options[service.selectedIndex].text : "layanan Anda";
        var techText = tech && tech.options ? tech.options[tech.selectedIndex].text : "tim kami";
        success.innerHTML = "<strong>Permintaan diterima.</strong> Kami telah mencatat " + escapeHtml(svcText) +
          " bersama " + escapeHtml(techText) +
          (date && date.value ? " pada " + escapeHtml(date.value) : "") +
          (time && time.value ? " pukul " + escapeHtml(time.value) : "") +
          ". Tim resepsionis kami akan menghubungi via WhatsApp/SMS dalam 1 jam untuk konfirmasi.";
        success.classList.add("is-visible");
        success.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "center" });
      }
      form.reset();
      form.querySelectorAll(".lq-slot.is-selected").forEach(function (s) { s.classList.remove("is-selected"); });
      var tv = form.querySelector("[data-slot-value]"); if (tv) tv.value = "";
    });
  }

  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[c];
    });
  }

  /* ---------------------------------------------------------------------
     Testimonials slider
     --------------------------------------------------------------------- */
  function initTestimonials() {
    var root = document.querySelector("[data-testi]");
    if (!root) return;
    var slides = root.querySelectorAll("[data-testi-slide]");
    var dots = root.querySelectorAll("[data-testi-dot]");
    if (slides.length < 2) return;
    var index = 0;
    var timer = null;

    function go(i) {
      index = (i + slides.length) % slides.length;
      slides.forEach(function (s, n) { s.classList.toggle("is-active", n === index); });
      dots.forEach(function (d, n) {
        d.classList.toggle("is-active", n === index);
        d.setAttribute("aria-selected", n === index ? "true" : "false");
      });
    }
    function next() { go(index + 1); }
    function start() { if (reduceMotion) return; stop(); timer = setInterval(next, 6000); }
    function stop() { if (timer) clearInterval(timer); }

    dots.forEach(function (dot, n) {
      dot.addEventListener("click", function () { go(n); start(); });
    });
    root.addEventListener("mouseenter", stop);
    root.addEventListener("mouseleave", start);
    root.addEventListener("focusin", stop);
    root.addEventListener("focusout", start);

    go(0);
    start();
  }

  /* ---------------------------------------------------------------------
     Count-up statistics
     --------------------------------------------------------------------- */
  function initCountUp() {
    var nums = document.querySelectorAll("[data-count]");
    if (!nums.length) return;
    if (reduceMotion || !("IntersectionObserver" in window)) {
      nums.forEach(function (el) {
        el.textContent = el.getAttribute("data-count") + (el.getAttribute("data-suffix") || "");
      });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var target = parseFloat(el.getAttribute("data-count"));
        var suffix = el.getAttribute("data-suffix") || "";
        var decimals = (el.getAttribute("data-count").split(".")[1] || "").length;
        var start = null;
        var dur = 1600;
        function step(ts) {
          if (!start) start = ts;
          var p = Math.min((ts - start) / dur, 1);
          var eased = 1 - Math.pow(1 - p, 3);
          el.textContent = (target * eased).toFixed(decimals) + suffix;
          if (p < 1) requestAnimationFrame(step);
          else el.textContent = target.toFixed(decimals) + suffix;
        }
        requestAnimationFrame(step);
        obs.unobserve(el);
      });
    }, { threshold: 0.5 });
    nums.forEach(function (el) { obs.observe(el); });
  }

  /* ---------------------------------------------------------------------
     Shopping bag counter
     --------------------------------------------------------------------- */
  function initShopBag() {
    var buttons = document.querySelectorAll("[data-bag-add]");
    var counter = document.querySelector("[data-bag-count]");
    if (!buttons.length) return;
    var count = 0;
    buttons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        count++;
        if (counter) {
          counter.textContent = count;
          counter.hidden = false;
        }
        btn.classList.add("is-added");
        var original = btn.getAttribute("data-label") || btn.textContent;
        btn.setAttribute("data-label", original);
        btn.textContent = "Ditambahkan";
        setTimeout(function () {
          btn.classList.remove("is-added");
          btn.textContent = original;
        }, 1400);
      });
    });
  }

  /* ---------------------------------------------------------------------
     Smooth-scroll for in-page anchors
     --------------------------------------------------------------------- */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (link) {
      link.addEventListener("click", function (e) {
        var id = link.getAttribute("href");
        var target = document.querySelector(id);
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
        history.replaceState(null, "", id);
      });
    });
  }

  /* --------------------------------------------------------------------- */
  document.addEventListener("DOMContentLoaded", function () {
    initStickyNav();
    initMobileNav();
    initReveal();
    initGalleryFilter();
    initLightbox();
    initSlots();
    initBookingForm();
    initTestimonials();
    initCountUp();
    initShopBag();
    initSmoothScroll();
  });
})();
