@extends('layouts.main')
@section('title', 'استعلام عن ICD10 ')

@section('content')
{{-- <ul class="kt-menu__nav">
    <li class="kt-menu__item" aria-haspopup="true">
        <a href="#" class="kt-menu__link">
            <span class="kt-menu__link-text">ICD Category</span>
        </a>
        <ul class="kt-menu__subnav">
            <li class="kt-menu__item">
                <a href="#" class="kt-menu__link">
                    <span class="kt-menu__link-text">Subcategory</span>
                </a>
            </li>
        </ul>
    </li>
</ul> --}}

<div class="container">
    <h1>ICD-10 Code Browser</h1>
    <ul id="icd-list">
        @foreach ($codes as $code)
        <li data-id="{{ $code->id }}">
            <strong>{{ $code->code }}</strong>: {{ $code->title }}
            @if ($code->children->count())
                <ul>
                    @foreach ($code->children as $child)
                    <li>
                        <strong>{{ $child->code }}</strong>: {{ $child->title }}
                    </li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>

<script>
    document.querySelectorAll('#icd-list li').forEach((li) => {
        li.addEventListener('click', async (e) => {
            e.stopPropagation();
            const id = li.getAttribute('data-id');

            // Fetch children via AJAX
            const response = await fetch(`/icd-codes/children/${id}`);
            const children = await response.json();

            if (children.length > 0) {
                let ul = document.createElement('ul');
                children.forEach((child) => {
                    let childLi = document.createElement('li');
                    childLi.innerHTML = `<strong>${child.code}</strong>: ${child.title}`;
                    ul.appendChild(childLi);
                });
                li.appendChild(ul);
            }
        });
    });
</script>
@endsection
