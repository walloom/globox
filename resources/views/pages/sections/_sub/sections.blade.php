
<div class="grid-stack" data-gs-animate="yes">
    @foreach($bodega->sections as $section)

    <?php
    $occupationLabel = '';
    if ($section->type == 'rack') {
        $occupationLabel = 'bg-success';
    }
    if (isset($section->rack->occupation) && $section->rack->occupation > 0 && $section->rack->occupation < 100) {
        $occupationLabel = 'bg-warning';
    }
    if (isset($section->rack->occupation) && $section->rack->occupation > 99.99) {
        $occupationLabel = 'bg-danger';
    }
    ?>
    <div class="grid-stack-item" data-click="open" data-bodega="{{ $bodega->id }}" data-type="{{ $section->type }}" data-id="{{ $section->id }}" data-rackid="{{ $section->rack->id??null }}" data-gs-x="{{ $section->x }}" data-gs-y="{{ $section->y }}" data-gs-width="{{ $section->w }}" data-gs-height="{{ $section->h }}">
        <div class="grid-stack-item-content {{ $occupationLabel }}">
            <span class="alias" data-rack="alias">{{ $section->alias }}</span>
            <small class="name" data-rack="name">{{ $section->name }}</small>
        </div>
    </div>
    @endforeach
</div>