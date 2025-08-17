@extends('layouts.main')
@section('title', 'ICD-10 Browser')
@section('content')
    <style>
        ul.list-group>li {
            cursor: pointer;
        }

        ul.list-group ul {
            margin-top: 5px;
        }
    </style>

    <div class="container-fluid">
        <!-- الشريط العلوي -->
        <div class="row">
            <div class="bg-success text-white p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center w-100">
                    <label for="searchInput" class="me-2 mb-0">Search</label>
                    <div class="position-relative flex-grow-1" style="max-width: 600px;">
                        <input type="text" id="icdInput" class="form-control" oninput="autocompleteICD(this.value)"
                            placeholder="Enter ICD Code">
                        <ul id="suggestionsList" class="list-group position-absolute" style="z-index: 1000;"></ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4" style="height: 100vh; overflow-y: auto;">
                <ul class="list-group">
                    @foreach ($sections as $section)
                        <li class="list-group-item">
                            <a class="text-primary fw-bold" data-bs-toggle="collapse" href="#collapse{{ $section->code }}"
                                role="button" aria-expanded="false" aria-controls="collapse{{ $section->code }}">
                                {{ $section->code }} : {{ $section->title }}
                            </a>

                            @if (isset($subsections[$section->code]))
                                <div class="collapse mt-2" id="collapse{{ $section->code }}">
                                    <ul class="list-group ms-3">
                                        @foreach ($subsections[$section->code] as $sub)
                                            <li class="list-group-item list-group-item-light">
                                                {{ $sub->code }} : {{ $sub->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>


            <div class="col-md-8">
                <div id="sectionDetails" class="p-3 fw-bold fs-5 text-dark text-end">
    اختر قسماً من القائمة لعرض التفاصيل هنا.
</div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

    <script>
        function loadSection(code) {
            fetch(`/icd-section/${code}`)
                .then(response => response.json())
                .then(data => {
                    let html = '<h5>التفاصيل:</h5><ul class="list-group">';
                    data.forEach(row => {
                        html += `<li class="list-group-item"><strong>${row.code}</strong>: ${row.title}</li>`;
                    });
                    html += '</ul>';
                    document.getElementById('sectionDetails').innerHTML = html;
                });
        }

        function autocompleteICD(query) {
            const list = document.getElementById('suggestionsList');
            list.innerHTML = '';

            if (query.length < 3) {
                list.style.display = 'none';
                return;
            }

            fetch(`{{ route('Report.icd-autocomplete', '') }}/${query}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        list.style.display = 'none';
                        return;
                    }

                    list.style.display = 'block';

                    data.forEach(row => {
                        const item = document.createElement('li');
                        item.className = 'list-group-item list-group-item-action';
                        item.textContent = `${row.code} - ${row.title}`;
                        item.onclick = () => {
                            document.getElementById('icdInput').value = row.code;
                            list.innerHTML = '';
                            document.getElementById('sectionDetails').innerHTML =
                                `<strong>${row.code}</strong>: ${row.title}`;
                        };
                        list.appendChild(item);
                    });
                })
                .catch(err => {
                    console.error(err);
                    list.style.display = 'none';
                });
        }
    </script>
