@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination epagination d-flex flex-wrap g-12">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link prev" href="{{ $paginator->previousPageUrl() }}"  aria-label="Previous"> <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.7309 14.7783L14.8242 13.685L11.2729 10.1259L14.8242 6.56688L13.7309 5.47357L9.07854 10.1259L13.7309 14.7783Z" fill="#0B162D"/>
                        <path d="M8.62154 14.7783L9.71484 13.685L6.16353 10.1259L9.71484 6.56688L8.62154 5.47357L3.96916 10.1259L8.62154 14.7783Z" fill="#0B162D"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev" href="{{ $paginator->previousPageUrl() }}"  aria-label="Previous"><svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.7309 14.7783L14.8242 13.685L11.2729 10.1259L14.8242 6.56688L13.7309 5.47357L9.07854 10.1259L13.7309 14.7783Z" fill="#0B162D"/>
                    <path d="M8.62154 14.7783L9.71484 13.685L6.16353 10.1259L9.71484 6.56688L8.62154 5.47357L3.96916 10.1259L8.62154 14.7783Z" fill="#0B162D"/>
                    </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link active ">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"><svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.26909 5.47363L4.17578 6.56694L7.72709 10.126L4.17578 13.6851L5.26909 14.7784L9.92146 10.126L5.26909 5.47363Z" fill="black"/>
                        <path d="M10.3785 5.47363L9.28516 6.56694L12.8365 10.126L9.28516 13.6851L10.3785 14.7784L15.0308 10.126L10.3785 5.47363Z" fill="black"/>
                        </svg>
                    </a>
                </li>
            @else
            <li class="page-item">
                <a class="page-link next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"><svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.26909 5.47363L4.17578 6.56694L7.72709 10.126L4.17578 13.6851L5.26909 14.7784L9.92146 10.126L5.26909 5.47363Z" fill="black"/>
                    <path d="M10.3785 5.47363L9.28516 6.56694L12.8365 10.126L9.28516 13.6851L10.3785 14.7784L15.0308 10.126L10.3785 5.47363Z" fill="black"/>
                    </svg>
                 </a>
            </li>
            @endif
        </ul>
    </nav>
@endif
