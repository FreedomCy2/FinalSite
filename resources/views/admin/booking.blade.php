@extends('admin.layout')

@section('title','Booking Management')
@section('header','Booking Management')

@section('content')
    {{-- Booking content (filters, stats, table) --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">All Bookings</h3>
            <div class="flex justify-between items-center mb-4">
                <button id="addBookingBtn" class="bg-[#68D6EC] text-white px-4 py-2 rounded">Add Booking</button>
            </div>
        </div>

        {{-- Table (static examples) --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                    <tbody id="booking-rows" class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                            <tr data-id="{{ $booking->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $booking->patient_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $booking->doctor_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $booking->appointment_time->format('d M, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $booking->appointment_time->format('h:i A') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ ucfirst($booking->status) }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button data-id="{{ $booking->id }}" class="text-[#68D6EC] mr-3 edit-booking">Edit</button>
                                    <button data-id="{{ $booking->id }}" class="text-red-600 delete-booking">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No bookings found</td>
                            </tr>
                        @endforelse
                    </tbody>
            </table>
        </div>
    </div>

        <!-- Modal and scripts for AJAX CRUD -->
        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create modal HTML
            const modalHtml = `
            <div id="bookingModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">
                <div class="bg-white rounded-lg w-2/3 max-w-2xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 id="modalTitle" class="text-lg font-semibold">Add New Booking</h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700"><i data-feather="x"></i></button>
                    </div>
                    <form id="bookingForm">
                        <input type="hidden" id="booking_id" />
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
                                <input id="patient_name" name="patient_name" type="text" placeholder="Patient name" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                                <input id="doctor_name" name="doctor_name" type="text" placeholder="Doctor name" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                    <input id="appointment_date" name="appointment_date" type="date" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                    <input id="appointment_time" name="appointment_time" type="time" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end mt-6 space-x-3">
                            <button type="button" id="cancelBooking" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700">Cancel</button>
                            <button type="submit" id="saveBooking" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg">Save Booking</button>
                        </div>
                    </form>
                </div>
            </div>`;

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            feather && feather.replace();

            const modal = document.getElementById('bookingModal');
            const addBtn = document.getElementById('addBookingBtn');
            const closeBtn = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBooking');
            const form = document.getElementById('bookingForm');

            function openModal(title = 'Add New Booking'){
                document.getElementById('modalTitle').textContent = title;
                modal.style.display = 'flex';
            }
            function closeModal(){ modal.style.display = 'none'; form.reset(); document.getElementById('booking_id').value = ''; }

            addBtn && addBtn.addEventListener('click', () => openModal('Add New Booking'));
            closeBtn && closeBtn.addEventListener('click', closeModal);
            cancelBtn && cancelBtn.addEventListener('click', closeModal);
            window.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

            // Attach edit listeners
            function attachEditListeners(){
                document.querySelectorAll('.edit-booking').forEach(btn => {
                    btn.removeEventListener('click', btn._editHandler);
                    btn._editHandler = async function(){
                        const id = this.dataset.id;
                        if (!id) return alert('Missing id');
                        try {
                            const res = await fetch(`/admin/bookings/${id}`, { headers: { 'Accept': 'application/json' } });
                            if (!res.ok) throw res;
                            const json = await res.json();
                            const b = json.data;
                            document.getElementById('booking_id').value = b.id;
                            document.getElementById('patient_name').value = b.patient_name;
                            document.getElementById('doctor_name').value = b.doctor_name;
                            const at = new Date(b.appointment_time);
                            document.getElementById('appointment_date').value = at.toISOString().slice(0,10);
                            document.getElementById('appointment_time').value = at.toTimeString().slice(0,5);
                            document.getElementById('status').value = b.status;
                            openModal('Edit Booking');
                        } catch(e){ alert('Failed to load booking'); }
                    };
                    btn.addEventListener('click', btn._editHandler);
                });
            }

            // Attach delete listeners
            function attachDeleteListeners(){
                document.querySelectorAll('.delete-booking').forEach(btn => {
                    btn.removeEventListener('click', btn._delHandler);
                    btn._delHandler = function(){
                        const id = this.dataset.id;
                        if (!id) return alert('Missing id');
                        if (!confirm('Are you sure you want to delete this booking?')) return;
                        fetch(`/admin/bookings/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept': 'application/json' } })
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
                const id = document.getElementById('booking_id').value;
                const payload = {
                    patient_name: document.getElementById('patient_name').value,
                    doctor_name: document.getElementById('doctor_name').value,
                    appointment_date: document.getElementById('appointment_date').value,
                    appointment_time: document.getElementById('appointment_time').value,
                    status: document.getElementById('status').value,
                };
                const url = id ? `/admin/bookings/${id}` : '/admin/bookings';
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
