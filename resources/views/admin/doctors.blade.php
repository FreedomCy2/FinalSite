@extends('admin.layout')

@section('title','Doctors')
@section('header','Doctors')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Doctors</h3>
            <button id="addDoctorBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add Doctor</button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody id="doctor-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr data-id="{{ $doctor->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->doctor_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->specialization }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->doctor_email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctor->doctor_phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $doctor->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($doctor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="edit-doctor text-[#68D6EC] mr-3" data-id="{{ $doctor->id }}">Edit</button>
                                <button class="delete-doctor text-red-600" data-id="{{ $doctor->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No doctors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal and AJAX scripts for Doctors CRUD -->
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalHtml = `
        <div id="doctorModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add Doctor</h3>
                    <button id="closeDoctorModal" class="text-gray-500 hover:text-gray-700"><i data-feather="x"></i></button>
                </div>
                <form id="doctorForm">
                    <input type="hidden" id="doctor_id" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input id="doctor_name" name="doctor_name" type="text" placeholder="Doctor name" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                            <input id="specialization" name="specialization" type="text" placeholder="Specialization" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="doctor_email" name="doctor_email" type="email" placeholder="Email" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input id="doctor_phone" name="doctor_phone" type="text" placeholder="Phone" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="doctor_status" name="doctor_status" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" id="cancelDoctor" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveDoctor" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        feather && feather.replace();

        const modal = document.getElementById('doctorModal');
        const addBtn = document.getElementById('addDoctorBtn');
        const closeBtn = document.getElementById('closeDoctorModal');
        const cancelBtn = document.getElementById('cancelDoctor');
        const form = document.getElementById('doctorForm');

        function openModal(title = 'Add Doctor'){
            document.getElementById('modalTitle').textContent = title;
            modal.style.display = 'flex';
        }
        function closeModal(){ modal.style.display = 'none'; form.reset(); document.getElementById('doctor_id').value = ''; }

        addBtn && addBtn.addEventListener('click', () => openModal('Add Doctor'));
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

        // Attach edit listeners
        function attachEditListeners(){
            document.querySelectorAll('.edit-doctor').forEach(btn => {
                btn.removeEventListener('click', btn._editHandler);
                btn._editHandler = async function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    try {
                        const res = await fetch(`/admin/doctors/${id}`, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const d = json.data;
                        document.getElementById('doctor_id').value = d.id;
                        document.getElementById('doctor_name').value = d.doctor_name || '';
                        document.getElementById('specialization').value = d.specialization || '';
                        document.getElementById('doctor_email').value = d.doctor_email || '';
                        document.getElementById('doctor_phone').value = d.doctor_phone || '';
                        document.getElementById('doctor_status').value = d.doctor_status || 'active';
                        openModal('Edit Doctor');
                    } catch(e){ alert('Failed to load doctor'); }
                };
                btn.addEventListener('click', btn._editHandler);
            });
        }

        // Attach delete listeners
        function attachDeleteListeners(){
            document.querySelectorAll('.delete-doctor').forEach(btn => {
                btn.removeEventListener('click', btn._delHandler);
                btn._delHandler = function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    if (!confirm('Are you sure you want to delete this doctor?')) return;
                    fetch(`/admin/doctors/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' } })
                    .then(async res => { if (!res.ok) throw res; return res.json(); })
                    .then(json => { const row = document.querySelector(`tr[data-id="${id}"]`); row && row.remove(); alert(json.message || 'Deleted'); })
                    .catch(async err => { let msg = 'Failed to delete'; try { const j = await err.json(); msg = j.message || msg; } catch(e){} alert(msg); });
                };
                btn.addEventListener('click', btn._delHandler);
            });
        }

        attachEditListeners();
        attachDeleteListeners();

        // Submit form (create/update)
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const id = document.getElementById('doctor_id').value;
            const payload = {
                doctor_name: document.getElementById('doctor_name').value,
                specialization: document.getElementById('specialization').value,
                doctor_email: document.getElementById('doctor_email').value,
                doctor_phone: document.getElementById('doctor_phone').value,
                doctor_status: document.getElementById('doctor_status').value,
            };
            const url = id ? `/admin/doctors/${id}` : '/admin/doctors';
            const method = id ? 'PUT' : 'POST';
            fetch(url, { method: method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' }, body: JSON.stringify(payload) })
            .then(async res => { if (res.status === 422) { const j = await res.json(); alert(Object.values(j.errors || {}).flat().join('\n') || j.message); throw new Error('validation'); } if (!res.ok) throw res; return res.json(); })
            .then(json => { alert(json.message || 'Saved'); location.reload(); })
            .catch(async err => { let msg = 'Failed to save'; try { const j = await err.json(); msg = j.message || msg; } catch(e){} if (msg !== 'validation') alert(msg); });
        });
    });
    </script>
    @endpush

@endsection