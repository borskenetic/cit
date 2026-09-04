@extends('layouts.sec')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/patrons/directory.css') }}">
@endsection

@section('content')
@php
    $yearValue = old('year', $student->year);
@endphp
<div class="patron-dir">
    <header class="patron-dir__hero">
        <div>
            <p class="patron-dir__eyebrow">Patron data</p>
            <h1 class="patron-dir__title">Edit student</h1>
            <p class="patron-dir__subtitle">
                {{ $student->lastname }}, {{ $student->firstname }}
                @if($student->id_number) · ID {{ $student->id_number }} @endif
            </p>
        </div>
        <div class="patron-dir__hero-actions">
            <a href="{{ route('students.index') }}" class="patron-dir__btn patron-dir__btn--outline">← Student directory</a>
        </div>
    </header>

    @include('patrons.partials.type_tabs', ['active' => 'students'])

    @if(session('success'))
        <div class="alert alert-success patron-dir__alert">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger patron-dir__alert">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger patron-dir__alert">
            <strong>Please fix the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="patron-dir__form-card">
        <form id="studentForm" class="patron-dir__form" method="POST"
              action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <section class="patron-dir__form-section">
                <h2 class="patron-dir__form-section-title">Identity</h2>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="firstname" class="form-label">First name <span class="required">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control"
                               value="{{ old('firstname', $student->firstname) }}" required autocomplete="given-name">
                    </div>
                    <div class="col-md-4">
                        <label for="lastname" class="form-label">Last name <span class="required">*</span></label>
                        <input type="text" name="lastname" id="lastname" class="form-control"
                               value="{{ old('lastname', $student->lastname) }}" required autocomplete="family-name">
                    </div>
                    <div class="col-md-4">
                        <label for="middle_initial" class="form-label">Middle initial</label>
                        @include('partials.middle_initial_input', [
                            'value' => old('middle_initial', $student->middle_initial),
                            'id' => 'middle_initial',
                        ])
                    </div>
                    <div class="col-md-3">
                        <label for="id_number" class="form-label">ID number <span class="required">*</span></label>
                        <input type="text" name="id_number" id="id_number" class="form-control"
                               value="{{ old('id_number', $student->id_number) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="qrcode" class="form-label">QR code</label>
                        <input type="text" name="qrcode" id="qrcode" class="form-control"
                               value="{{ old('qrcode', $student->qrcode) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="rfid" class="form-label">RFID</label>
                        <input type="text" name="rfid" id="rfid" class="form-control"
                               value="{{ old('rfid', $student->rfid) }}"
                               placeholder="Scan RFID strip" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="form-control"
                               value="{{ old('birthday', $student->birthday) }}">
                    </div>
                </div>
            </section>

            <section class="patron-dir__form-section">
                <h2 class="patron-dir__form-section-title">Academic</h2>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label for="course" class="form-label">Program</label>
                        <select name="course" id="course" class="form-select">
                            <option value="">Select program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->program_code }}"
                                    @selected(old('course', $student->course) == $program->program_code)>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                            @if(old('course', $student->course) && !$programs->contains(fn ($p) => $p->program_code === old('course', $student->course)))
                                <option value="{{ old('course', $student->course) }}" selected>
                                    {{ old('course', $student->course) }}
                                </option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="year" class="form-label">Year level</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">Select year</option>
                            @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year', '6th Year'] as $yr)
                                @php
                                    $aliases = [
                                        '1st Year' => ['1st Year', 'First Year'],
                                        '2nd Year' => ['2nd Year', 'Second Year'],
                                        '3rd Year' => ['3rd Year', 'Third Year'],
                                        '4th Year' => ['4th Year', 'Fourth Year'],
                                        '5th Year' => ['5th Year', 'Fifth Year'],
                                        '6th Year' => ['6th Year', 'Sixth Year'],
                                    ];
                                @endphp
                                <option value="{{ $yr }}" @selected(in_array($yearValue, $aliases[$yr], true))>
                                    {{ $yr }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>

            <section class="patron-dir__form-section">
                <h2 class="patron-dir__form-section-title">Contact</h2>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="mobile_number" class="form-label">Mobile number</label>
                        <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                               placeholder="09XXXXXXXXX"
                               value="{{ old('mobile_number', $student->mobile_number) }}" inputmode="tel">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="For reservation alerts"
                               value="{{ old('email', $student->email) }}" autocomplete="email">
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control"
                               placeholder="Complete address"
                               value="{{ old('address', $student->address) }}">
                    </div>
                </div>
            </section>

            <section class="patron-dir__form-section">
                <h2 class="patron-dir__form-section-title">Photo &amp; signature</h2>
                <div class="row g-2 align-items-start">
                    <div class="col-md-4">
                        <label for="profile_picture" class="form-label">Profile photo</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control"
                               accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        <p class="patron-dir__form-hint mb-2">JPG or PNG, max 2 MB.</p>
                        @if($student->profile_picture)
                            <img src="{{ asset($student->profile_picture) }}"
                                 alt="Current profile"
                                 class="rounded border"
                                 style="width: 96px; height: 96px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Signature</label>
                        <div class="patron-dir__signature-wrap">
                            <canvas id="studentSignaturePad" width="520" height="120"></canvas>
                        </div>
                        <input type="hidden" name="student_signature" id="studentSignatureInput"
                               value="{{ old('student_signature') }}">
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                            <button type="button" id="clearStudentSignature"
                                    class="patron-dir__btn patron-dir__btn--outline patron-dir__btn--sm">
                                Clear signature
                            </button>
                            @if($student->student_signature)
                                <span class="patron-dir__form-hint mb-0">Current:</span>
                                <img src="{{ asset($student->student_signature) }}"
                                     alt="Current signature"
                                     height="40"
                                     class="border rounded bg-white">
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section class="patron-dir__form-section">
                <h2 class="patron-dir__form-section-title">Emergency contact</h2>
                <div class="row g-2">
                    <div class="col-md-3">
                        <label for="emergency_person" class="form-label">Contact person</label>
                        <input type="text" name="emergency_person" id="emergency_person" class="form-control"
                               value="{{ old('emergency_person', $student->emergency_person) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="emergency_relationship" class="form-label">Relationship</label>
                        <input type="text" name="emergency_relationship" id="emergency_relationship" class="form-control"
                               placeholder="e.g. Parent"
                               value="{{ old('emergency_relationship', $student->emergency_relationship) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="emergency_number" class="form-label">Contact number</label>
                        <input type="text" name="emergency_number" id="emergency_number" class="form-control"
                               placeholder="09XXXXXXXXX"
                               value="{{ old('emergency_number', $student->emergency_number) }}" inputmode="tel">
                    </div>
                    <div class="col-md-3">
                        <label for="emergency_address" class="form-label">Address</label>
                        <input type="text" name="emergency_address" id="emergency_address" class="form-control"
                               value="{{ old('emergency_address', $student->emergency_address) }}">
                    </div>
                </div>
            </section>

            <div class="patron-dir__form-actions">
                <a href="{{ route('students.index') }}" class="patron-dir__btn patron-dir__btn--outline">Cancel</a>
                <button type="submit" class="patron-dir__btn patron-dir__btn--primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/signature_pad/signature_pad.umd.min.js') }}"></script>
<script>
    (function () {
        const canvas = document.getElementById('studentSignaturePad');
        const input = document.getElementById('studentSignatureInput');
        if (!canvas || !window.SignaturePad) return;

        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
        });

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            const width = canvas.parentElement.clientWidth;
            const height = 120;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            const data = signaturePad.isEmpty() ? null : signaturePad.toData();
            signaturePad.clear();
            if (data) signaturePad.fromData(data);
        }

        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        document.getElementById('clearStudentSignature')?.addEventListener('click', () => {
            signaturePad.clear();
            input.value = '';
        });

        document.getElementById('studentForm')?.addEventListener('submit', () => {
            if (!signaturePad.isEmpty()) {
                input.value = signaturePad.toDataURL();
            }
        });
    })();
</script>
@endsection
