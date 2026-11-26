<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $activeTab = $request->query('tab', 'appointment');
        $appointments = Appointment::with(['items', 'artist'])
            ->orderBy('appointment_date')
            ->orderBy('time_slot')
            ->get();

        $appointmentsByDate = [];
        foreach ($appointments as $appt) {
            $dateKey = $appt->appointment_date->toDateString();
            $layananNames = $appt->items
                ->where('is_addon', false)
                ->pluck('item_name')
                ->implode(' + ');

            $appointmentsByDate[$dateKey][] = [
                'id' => $appt->id,
                'booking_code' => $appt->booking_code,
                'jam' => $appt->time_slot,
                'pelanggan' => $appt->client_name,
                'layanan' => $layananNames !== '' ? $layananNames : 'Perawatan Studio',
                'artist' => $appt->artist?->name ?? 'Aurel',
                'status' => $appt->status,
                'dp_amount' => $appt->dp_amount,
                'final_total' => $appt->final_total,
                'final_payment_status' => $appt->final_payment_status,
            ];
        }

        $todayDate = Carbon::today()->toDateString();
        $todayShort = Carbon::today()->format('d M');
        $todayFullShort = Carbon::today()->format('d M Y');

        $addonServices = Service::where('is_active', true)
            ->where('service_type', 'addon')
            ->get();

        return view('admin.dashboard', compact(
            'activeTab',
            'appointments',
            'appointmentsByDate',
            'todayDate',
            'todayShort',
            'todayFullShort',
            'addonServices'
        ));
    }

    public function cuti(): View
    {
        return view('admin.cuti');
    }

    public function katalog(): View
    {
        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'gel-polish', 'name' => 'Gel Polish'],
            ['id' => 'nail-art-custom', 'name' => 'Nail art custom'],
            ['id' => 'nail-extension', 'name' => 'Nail Extension'],
        ];

        $services = Service::where('is_active', true)
            ->where('service_type', 'catalog')
            ->where('uploader_role', 'like', '%Admin%')
            ->get()
            ->map(function (Service $svc): array {
                return [
                    'id' => $svc->id,
                    'name' => $svc->name,
                    'category' => $svc->category,
                    'category_label' => $svc->category_label,
                    'price' => $svc->price,
                    'duration' => $svc->duration,
                    'image' => $svc->image_url,
                    'uploaded_by' => $svc->uploaded_by,
                    'uploader_role' => $svc->uploader_role,
                    'uploader_avatar' => asset('img/tech-2.jpg'),
                    'description' => $svc->description,
                ];
            })
            ->all();

        return view('admin.katalog', compact('categories', 'services'));
    }
}
