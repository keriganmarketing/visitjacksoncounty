<div class="col-md-6 col-lg-3 p-4">
    <div class="card h-100 shadow event">
        <a href="{{ get_permalink($event->ID) }}" class="embed-responsive embed-responsive-1by1 event-image" v-lazy:background-image="'{{ $event->main_photo['sizes']['large'] }}'" ></a>
        <div class="card-body text-center pb-0 pt-4">
            <p class="card-title">{{ $event->post_title }}</p>

            @if($event->recurring_period == 'none')
            <p class="card-date m-0">{{ date('M j, Y', strtotime($event->event_start)) . ($event->event_start != $event->event_end ? ' to ' .date('M j, Y', strtotime($event->event_end)) : null) }}</p>
            @endif

            @if($event->recurring_period == 'everyday')
            <p class="card-date m-0">Everyday<br> {{ date('M j, Y', strtotime($event->event_start)) }} to {{ date('M j, Y', strtotime($event->event_end)) }}</p>
            @endif

            @if($event->recurring_period == 'weekly')
                <p class="card-date m-0">Every 
                @foreach($event->what_day as $day)
                    {{ ($loop->last ? ' & ' : '') . $day['label'] . ($loop->last || $loop->iteration == $loop->count-1 ? '' : ', ') }}
                @endforeach
                @if($event->event_end)
                until {{ date('M j, Y', strtotime($event->event_end)) }}
                @endif
                </p>
            @endif

            @if($event->recurring_period == 'monthly')
            <p class="card-date m-0">{{ date('M j, Y', strtotime($event->event_start)) }}</p>
            @endif

            @if($event->event_time)
            <p class="card-time m-">{{ $event->event_time }}</p>
            @endif
        </div>
        <div class="card-bottom text-center pb-4">
            <a class="text-dark font-weight-bold" href="{{ get_permalink($event->ID) }}" >MORE INFO <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <div class="gradient gradient-one"></div>
    </div>
</div>