<ul class="message-body">
  @foreach($messages as $row)
    @php $sender_id = $row->sender; @endphp
    @if($first_sender == $sender_id)
    <li
      class="message-to-me d-flex justify-content-start align-items-start g-14" id="mes_id_{{ $row->message_id }}"
    >
      <!-- User Photo -->
      <div class="user-photo-2">
        <div class="img">
          <img src="{{ get_user_image($row->sender) }}" alt="" />
        </div>
      </div>
      <!-- Message -->
      <div class="message-text">
        <div
          class="message-user pt-10 d-flex align-items-center g-20 pb-17"
        >
          <h3 class="fz-14-sb-black">{{ $sender }}</h3>
          <p class="fz-13-m-grayish">{{ timeAgo($row->created_at) }}</p>
        </div>
        <ul class="message-list">
          <li><p>{{ $row->message }}</p></li>
        </ul>
      </div>
    </li>
    @else
    <li
      class="message-for-me d-flex justify-content-start align-items-start g-14 flex-row-reverse" id="mes_id_{{ $row->message_id }}"
    >
      <!-- User Photo -->
      <div class="user-photo-2">
        <div class="img">
          <img src="{{ get_user_image($row->sender) }}" alt="" />
        </div>
      </div>
      <!-- Message -->
      <div class="message-text">
        <div
          class="message-user pt-10 d-flex align-items-center g-20 flex-row-reverse pb-17"
        >
          <h3 class="fz-14-sb-black">{{ $receiver }}</h3>
          <p class="fz-13-m-grayish">{{ timeAgo($row->created_at) }}</p>
        </div>
        <ul class="message-list">
          <li>
            <p>{{ $row->message }}</p>
          </li>
        </ul>
      </div>
    </li>
    @endif
  @endforeach
</ul>
