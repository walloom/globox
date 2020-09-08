
<h5 class="h6">
    Vista previa
    <strong class="float-right">Oupación: {{ number_format($rack->occupation,2,'.','.') }}%</strong>
</h5>
<div class="rack mb-3">
    @foreach(range(1,$rack->modules) as $item)
    <div class="module" style="height: {{ 55*$rack->levels }}px; width: {{ 100/$rack->modules }}%;">
        @foreach(range($rack->levels,1) as $level)
        <div class="level" style="height: {{ 100/$rack->levels }}% ">
            <div class="sections">
                <?php
                $ubicationRCode = $rack->alias . '-' . $level . '-' . $item . '-R';
                $ubicationLCode = $rack->alias . '-' . $level . '-' . $item . '-L';

                $ubicationR = $rack->ubications()->firstWhere('code', $ubicationRCode);
                $ubicationL = $rack->ubications()->firstWhere('code', $ubicationLCode);
                ?>    
                <div class="section {{ $ubicationR->available?'bg-success':'bg-danger' }}" data-click="ubication" data-bodega="{{ $bodega_id }}" data-rack="{{ $rack->id }}"  data-id="{{ $ubicationR->id }}" >
                    <small>{{ $ubicationRCode }}</small>
                </div>
                <div class="section {{ $ubicationL->available?'bg-success':'bg-danger' }}" data-click="ubication" data-bodega="{{ $bodega_id }}" data-rack="{{ $rack->id }}" data-id="{{ $ubicationL->id }}">
                    <small>{{ $ubicationLCode }}</small>
                </div>
            </div>
        </div> 
        @endforeach
    </div>
    @endforeach
</div>
