<div id="filter" class="modal fade" tabindex="88" aria-labelledby="filter-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="card">
                <div class="card-header border-bottom-dashed align-items-center d-flex">
                    <div class="d-flex gap-2">
                        Filter Data
                    </div>
                </div>
                <div class="card-footer" style="z-index: 1055;">
                         @forelse ($list as $l)
                            @if($l['filter'])
                                     <label for="{{ $l['field'] }}" class=" form-label">
                                        {{ $l['field'] }}
                                      
                                    </label>
                                    @if($l['type'] === 'select')
                                        <select class="form-control select2"
                                                id="{{ $l['field'] }}"
                                                name="{{ $l['field'] }}"
                                                @if($l['required']) required @endif 
                                                aria-describedby="{{ $l['field'] }}Help">
                                        
                                                <option value="" selected>{{ __('global.select') }}</option>
                                        
                                            @foreach($l['option'] as $opt)
                                                <option value="{{ $opt['id'] }}">{{ $opt['value'] }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="{{ $l['type'] }}"
                                               name="{{ $l['field'] }}"
                                               class="form-control"
                                               id="{{ $l['field'] }}" 
                                               aria-describedby="{{ $l['field'] }}Help">
                                    @endif
                             @endif
                        @empty
                            <span>No data available</span>
                        @endforelse
                 </div>
            </div>
        </div>
    </div>
</div>
