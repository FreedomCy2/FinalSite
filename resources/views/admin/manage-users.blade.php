@extends('admin.layout')

@section('title','Users')
@section('header','Users')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">User</h3>
            <button id="addUserBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add User</button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="user-rows" class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->service }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ 
                                
                                ($user->date) ? \Carbon\Carbon::parse($user->date)->format('d M, Y') : ''
                            }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button data-id="{{ $user->id }}" class="edit-user text-[#68D6EC] mr-3">Edit</button>
                                <button data-id="{{ $user->id }}" class="delete-user text-red-600">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No user found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalHtml = `
        <div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
            <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold">Add User</h3>
                    <button id="closeUserModal" class="text-gray-500 hover:text-gray-700"><i data-feather="x"></i></button>
                </div>
                <form id="userForm">
                    <input type="hidden" id="user_id" />
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                            <input id="service" name="service" type="text" placeholder="Service" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input id="date" name="date" type="date" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                <input id="time" name="time" type="time" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input id="user_name" name="name" type="text" placeholder="Name" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="user_email" name="email" type="email" placeholder="Email" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                <input id="age" name="age" type="number" placeholder="Age" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <input id="gender" name="gender" type="text" placeholder="Gender" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Symptom / Notes</label>
                            <textarea id="symptom" name="symptom" class="w-full rounded-lg border border-gray-300 px-3 py-2" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" id="cancelUser" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                        <button type="submit" id="saveUser" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>`;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        feather && feather.replace();

        const modal = document.getElementById('userModal');
        const addBtn = document.getElementById('addUserBtn');
        const closeBtn = document.getElementById('closeUserModal');
        const cancelBtn = document.getElementById('cancelUser');
        const form = document.getElementById('userForm');

        function openModal(title = 'Add User'){
            document.getElementById('modalTitle').textContent = title;
            modal.style.display = 'flex';
        }
        function closeModal(){ modal.style.display = 'none'; form.reset(); document.getElementById('user_id').value = ''; }

        addBtn && addBtn.addEventListener('click', () => openModal('Add User'));
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

        function attachEditListeners(){
            document.querySelectorAll('.edit-user').forEach(btn => {
                btn.removeEventListener('click', btn._editHandler);
                btn._editHandler = async function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    try {
                        const res = await fetch(`/admin/users/${id}`, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const u = json.data;
                        document.getElementById('user_id').value = u.id;
                        document.getElementById('service').value = u.service || '';
                        document.getElementById('date').value = u.date || '';
                        document.getElementById('time').value = u.time || '';
                        document.getElementById('user_name').value = u.name || '';
                        document.getElementById('user_email').value = u.email || '';
                        document.getElementById('phone').value = u.phone || '';
                        document.getElementById('age').value = u.age || '';
                        document.getElementById('gender').value = u.gender || '';
                        document.getElementById('symptom').value = u.symptom || '';
                        openModal('Edit Booking');
                    } catch(e){ alert('Failed to load booking'); }
                };
                btn.addEventListener('click', btn._editHandler);
            });
        }

        function attachDeleteListeners(){
            document.querySelectorAll('.delete-user').forEach(btn => {
                btn.removeEventListener('click', btn._delHandler);
                btn._delHandler = function(){
                    const id = this.dataset.id;
                    if (!id) return alert('Missing id');
                    if (!confirm('Are you sure you want to delete this user?')) return;
                    fetch(`/admin/users/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' } })
                    .then(async res => { if (!res.ok) throw res; return res.json(); })
                    .then(json => { const row = document.querySelector(`tr[data-id="${id}"]`); row && row.remove(); alert(json.message || 'Deleted'); })
                    .catch(async err => { let msg = 'Failed to delete'; try { const j = await err.json(); msg = j.message || msg; } catch(e){} alert(msg); });
                };
                btn.addEventListener('click', btn._delHandler);
            });
        }

        attachEditListeners();
        attachDeleteListeners();

        form.addEventListener('submit', function(e){
            e.preventDefault();
            const id = document.getElementById('user_id').value;
            const payload = {
                service: document.getElementById('service').value,
                date: document.getElementById('date').value,
                time: document.getElementById('time').value,
                name: document.getElementById('user_name').value,
                email: document.getElementById('user_email').value,
                phone: document.getElementById('phone').value,
                age: document.getElementById('age').value,
                gender: document.getElementById('gender').value,
                symptom: document.getElementById('symptom').value,
            };
            const url = id ? `/admin/users/${id}` : '/admin/users';
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
