<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $activeTab = $request->query('tab', 'appointment');
        $appointments = Appointment::with(['items', 'artist'])
            ->orderByDesc('appointment_date')
            ->orderBy('time_slot')
            ->get();
        $addonServices = Service::where('is_active', true)
            ->where('service_type', 'addon')
            ->get();

        return view('admin.dashboard', compact('activeTab', 'appointments', 'addonServices'));
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
