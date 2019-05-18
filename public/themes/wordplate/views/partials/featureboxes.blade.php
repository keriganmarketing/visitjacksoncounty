<div class="feature-box-section">
        <div class="row no-gutters">
            @foreach($featureBoxes as $featureBox)
            <div class="col {{ $featureBox['class'] }} box-container flex-grow-1 embed-responsive embed-responsive-1by1">
                <div 
                    class="feature-box embed-responsive-item" 
                    v-lazy:background-image="{src: '{{ $featureBox['background_image']['url'] }}'}"
                    style="
                        {{ ($featureBox['box_color'] != '' ? 'background-color: ' . $featureBox['box_color'] . ';' : '') }}
                        {{ ($featureBox['border_color'] != '' ? 'border: 1px solid ' . $featureBox['border_color'] . ';' : '') }}
                        {{ ($featureBox['text_color'] != '' ? 'color: ' . $featureBox['text_color'] . ';' : '') }}"
                >
                    @if($featureBox['link'] != '')
                    <a class="box-content h-100 d-flex flex-column justify-content-center align-items-center" href="{{ $featureBox['link'] }}" style="display:block" >
                    @endif

                        <p class="box-headline">{{ $featureBox['headline'] }}</p>
                        <p class="box-text">{{ $featureBox['text'] }}</p>
                        <p class="box-button" >{{ $featureBox['link_text'] }}</p>

                    @if($featureBox['link'] != '') 
                    </a> 
                    @endif

                    @if($featureBox['overlay'] != '')
                    <div class="overlay" style="background-color: {{ $featureBox['overlay'] }};"></div>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
</div>