<?php

namespace App\Http\Controllers\vehiclesController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver\Driver;
use Illuminate\Support\Facades\File;

class DriverController extends Controller
{
    public function create()
    {
        return view('vehicles.driver.create');

    }

    public function store(Request $request)
    {
        // \Log::info($request->all());
        $request->validate([
            'employee_number' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'cnic_number' => 'required|string|max:15',
            'permanent_address' => 'required|string|max:255',
            'temporary_address' => 'required|string|max:255',
            'contact_number' => 'required|array|min:1',
            'contact_number.*' => 'required|string|max:12',
            'blood_group' => 'required|string|max:3',
            'disability' => 'nullable|string|max:255',
            'emergency_contact' => 'required|string|max:12',
            'marital_status' => 'required|string|max:255',
            'health_certificate' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'driver_photo' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'license_images' => 'required|array',
            'license_images.*' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'cnic_images' => 'required|array',
            'cnic_images.*' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'reference_name' => 'required|array|min:1|max:3',
            'reference_name.*' => 'required|string|max:255',
            'relationship' => 'required|array|min:1|max:3',
            'relationship.*' => 'required|string|max:255',
            'reference_contact' => 'required|array|min:1|max:3',
            'reference_contact.*' => 'required|string|max:12',
            'reference_cnic' => 'required|array|min:1|max:3',
            'reference_cnic.*' => 'required|string|max:15',
            'reference_address' => 'required|array|min:1|max:3',
            'reference_address.*' => 'required|string|max:255',
        ]);

        $basePath = public_path('images/driverImages');
        $fullName = str_replace(' ', '_', $request->employee_number); // saving the images on the basis of employee number .

        // Create folders
        $updatedataFolder = $basePath . '/' . $fullName;
        $healthCertificateFolder = $updatedataFolder . '/health_certificate';
        $photoFolder = $updatedataFolder . '/driver_photo';
        $licenseFolder = $updatedataFolder . '/licenses';
        $cnicFolder = $updatedataFolder . '/cnics';

        // Ensure folders exist
        File::makeDirectory($updatedataFolder, 0755, true, true);
        File::makeDirectory($healthCertificateFolder, 0755, true, true);
        File::makeDirectory($photoFolder, 0755, true, true);
        File::makeDirectory($licenseFolder, 0755, true, true);
        File::makeDirectory($cnicFolder, 0755, true, true);

        // Save driver data
        $storedata = new Driver;
        $storedata->employee_number = $request->employee_number;
        $storedata->full_name = $request->full_name;
        $storedata->father_name = $request->father_name;
        $storedata->date_of_birth = $request->date_of_birth;
        $storedata->cnic_number = $request->cnic_number;
        $storedata->permanent_address = $request->permanent_address;
        $storedata->temporary_address = $request->temporary_address;
        $storedata->contact_number = implode(',', $request->contact_number);
        $storedata->blood_group = $request->blood_group;
        $storedata->disability = $request->disability;
        $storedata->emergency_contact = $request->emergency_contact;
        $storedata->marital_status = $request->marital_status;

        if ($request->hasFile('health_certificate')) {
            $healthCertificateName = $fullName . '_health_certificate.' . $request->file('health_certificate')->getClientOriginalExtension();
            $request->file('health_certificate')->move($healthCertificateFolder, $healthCertificateName);
            $storedata->health_certificate = 'images/driverImages/' . $fullName . '/health_certificate/' . $healthCertificateName;
        }

        if ($request->hasFile('driver_photo')) {
            $updatedataPhotoName = $fullName . '_photo.' . $request->file('driver_photo')->getClientOriginalExtension();
            $request->file('driver_photo')->move($photoFolder, $updatedataPhotoName);
            $storedata->driver_photo = 'images/driverImages/' . $fullName . '/driver_photo/' . $updatedataPhotoName;
        }

        if ($request->hasFile('license_images')) {
            $licenseImages = [];
            foreach ($request->file('license_images') as $file) {
                $licenseImageName = $fullName . '_license_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($licenseFolder, $licenseImageName);
                $licenseImages[] = 'images/driverImages/' . $fullName . '/licenses/' . $licenseImageName;
            }
            $storedata->license_images = implode(',', $licenseImages);
        }

        if ($request->hasFile('cnic_images')) {
            $cnicImages = [];
            foreach ($request->file('cnic_images') as $file) {
                $cnicImageName = $fullName . '_cnic_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($cnicFolder, $cnicImageName);
                $cnicImages[] = 'images/driverImages/' . $fullName . '/cnics/' . $cnicImageName;
            }
            $storedata->cnic_images = implode(',', $cnicImages);
        }

        $storedata->reference_name = implode(',', $request->reference_name);
        $storedata->relationship = implode(',', $request->relationship);
        $storedata->reference_contact = implode(',', $request->reference_contact);
        $storedata->reference_cnic = implode(',', $request->reference_cnic);
        $storedata->reference_address = implode(',', $request->reference_address);

        // Save driver record
        $storedata->save();
        return redirect()->route('drivers.index')->with('success', 'Driver information has been saved successfully.');

    }

    public function index()
    {
        $indexdata = Driver::all();
        return view('vehicles.driver.index', compact('indexdata'));
    
    }

    public function edit($id)
    {
        $editdata = Driver::find($id);
        return view('vehicles.driver.update', compact('editdata'));

    }

    public function destroy($id)
    {
        $deletedata = Driver::find($id);
        $deletedata->delete();
        return redirect()->route('drivers.index');

    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'employee_number' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'cnic_number' => 'required|string|max:15',
            'permanent_address' => 'required|string|max:255',
            'temporary_address' => 'required|string|max:255',
            'contact_number' => 'required|array|min:1',
            'contact_number.*' => 'required|string|max:12',
            'blood_group' => 'required|string|max:3',
            'disability' => 'nullable|string|max:255',
            'emergency_contact' => 'required|string|max:12',
            'marital_status' => 'required|string|max:255',
            'health_certificate' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'driver_photo' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'license_images' => 'nullable|array',
            'license_images.*' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'cnic_images' => 'nullable|array',
            'cnic_images.*' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'reference_name' => 'required|array|min:1|max:3',
            'reference_name.*' => 'required|string|max:255',
            'relationship' => 'required|array|min:1|max:3',
            'relationship.*' => 'required|string|max:255',
            'reference_contact' => 'required|array|min:1|max:3',
            'reference_contact.*' => 'required|string|max:12',
            'reference_cnic' => 'required|array|min:1|max:3',
            'reference_cnic.*' => 'required|string|max:15',
            'reference_address' => 'required|array|min:1|max:3',
            'reference_address.*' => 'required|string|max:255',
        ]);
    
        $updatedata = Driver::findOrFail($id);
        $basePath = public_path('images/driverImages');
        $fullName = str_replace(' ', '_', $request->employee_number);
    
        $driverFolder = $basePath . '/' . $request->employee_number;
    
        if (!File::exists($driverFolder)) {
            File::makeDirectory($driverFolder, 0755, true);
        }
    
        if ($request->hasFile('driver_photo')) {
            $oldPhotoPath = public_path($updatedata->driver_photo);
            if (file_exists($oldPhotoPath)) {
                @unlink($oldPhotoPath);
            }
    
            $photoName = time() . '.' . $request->file('driver_photo')->getClientOriginalExtension();
            $request->file('driver_photo')->move($driverFolder, $photoName);
            $updatedata->driver_photo = 'images/driverImages/' . $request->employee_number . '/' . $photoName;
        }
    
        if ($request->hasFile('health_certificate')) {
            $oldCertPath = public_path($updatedata->health_certificate);
            if (file_exists($oldCertPath)) {
                @unlink($oldCertPath);
            }
    
            $certName = time() . '.' . $request->file('health_certificate')->getClientOriginalExtension();
            $request->file('health_certificate')->move($driverFolder, $certName);
            $updatedata->health_certificate = 'images/driverImages/' . $request->employee_number . '/' . $certName;
        }
    
        if ($request->hasFile('license_images')) {
            foreach ($request->file('license_images') as $file) {
                $licenseName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($driverFolder . '/licenses', $licenseName);
            }
        }
    
        if ($request->hasFile('cnic_images')) {
            foreach ($request->file('cnic_images') as $file) {
                $cnicName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($driverFolder . '/cnics', $cnicName);
            }
        }
    
        $updatedata->employee_number = $request->employee_number;
        $updatedata->full_name = $request->full_name;
        $updatedata->father_name = $request->father_name;
        $updatedata->date_of_birth = $request->date_of_birth;
        $updatedata->cnic_number = $request->cnic_number;
        $updatedata->permanent_address = $request->permanent_address;
        $updatedata->temporary_address = $request->temporary_address;
        $updatedata->contact_number = $request->contact_number;
        $updatedata->blood_group = $request->blood_group;
        $updatedata->disability = $request->disability;
        $updatedata->emergency_contact = $request->emergency_contact;
        $updatedata->marital_status = $request->marital_status;
        $updatedata->reference_name = implode(',', $request->reference_name);
        $updatedata->relationship = implode(',', $request->relationship);
        $updatedata->reference_contact = implode(',', $request->reference_contact);
        $updatedata->reference_cnic = implode(',', $request->reference_cnic);
        $updatedata->reference_address = implode(',', $request->reference_address);
    
        $updatedata->save();
    
        return redirect()->route('drivers.index')->with('success', 'Driver information has been updated successfully.');
    }
    


}
