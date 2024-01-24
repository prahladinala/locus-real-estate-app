@extends('customer.index')
@section('customerRightPanel')

<?php use App\Models\MessageThread; ?>

<style type="text/css">
  .custom-height {
    max-height: 500px;
    overflow-y: auto;
  }
</style>

<div class="col-lg-9">
  <div
    class="dl_column_content d-flex flex-column rg-30 overflow-hidden"
  >
    <!-- Message -->
    <div class="boxShadow-06 bg-white pr-20 pt-22 pb-30 bd-r-5">
      <div class="row">
        <div class="col-lg-4 pe-lg-0">
          <div class="message-left">
            <!-- Title & Search -->
            <div class="pl-20">
              <h4 class="fz-20-sb-black pb-20">{{ get_phrase('Message') }}</h4>
              <hr class="m-2">
            </div>
            <!-- Message Nav -->
            <ul
              class="nav messaging-nav pt-30"
              id="pills-tab"
              role="tablist"
            >
            @foreach($message_threads as $row)
              @if($row->sender == auth()->user()->id)
                @php $user_name = $row->message_to_receiver->name; @endphp
              @endif
              @if($row->receiver == auth()->user()->id)
                @php $user_name = $row->message_to_sender->name; @endphp
              @endif
              @php 
              $unread_message_number = count_unread_message_of_thread($row->message_thread_code);
              @endphp
              <li class="nav-item" role="presentation">
                <div
                  class="ins-nav-link <?php if(isset($current_message_thread_code) && $current_message_thread_code == $row->message_thread_code) echo 'active';?>"
                  id="user1-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#user1"
                  role="tab"
                  aria-controls="user1"
                  aria-selected="true"
                >
                  <a href="{{ route('agentMesssage', ['param1' => 'message_read', 'param2' => $row->message_thread_code]) }}">
                    <div
                      class="user-message d-flex align-items-center g-13"
                    >
                      <div class="userImg">
                        <img src="{{ get_user_image($row->receiver) }}" alt="" />
                      </div>
                      <div
                        class="userInfo d-flex justify-content-between align-items-start d-none d-lg-block"
                      >
                        <div class="text-start">
                          <h4 class="fz-16-sb-black">
                            {{ $user_name }}
                            @if($unread_message_number > 0)
                            <span class="nav-item-notify float-end">
                                <?= $unread_message_number; ?>
                            </span>
                            @endif
                          </h4>
                        </div>
                        <p class="fz-16-m-blackish">{{ timeAgo($row->created_at) }}</p>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="message-right">
            <div
              class="tab-content ins-nav-content"
              id="pills-tabContent"
            >
              <div
                class="tab-pane fade show active" id="user1" role="tabpanel" aria-labelledby="user1-tab">

                @if(isset($current_message_thread_code) & $current_message_thread_code != '')
                <?php

                $message_thread_details = MessageThread::where('message_thread_code' , $current_message_thread_code)->first();
                $receiver = $message_thread_details->message_to_receiver->name;

                ?>

                <div class="m-body" id="message_body">
                  <!-- Message Header -->
                  <div
                    class="message-header d-flex justify-content-between align-items-center pb-20 mb-20"
                  >
                    <div class="user-name">
                      <h4 class="fz-16-sb-black">{{ $receiver }}</h4>
                    </div>
                    <div
                      class="user-photo d-flex align-items-center g-10"
                    >
                      <div class="img">
                        <img src="{{ get_user_image($row->receiver) }}" alt="" />
                      </div>
                      {{-- <i class="fa-solid fa-ellipsis-vertical"></i> --}}
                    </div>
                  </div>
                  <!-- Message Body -->
                  <div class="custom-height" id="scroll">
                    @include('customer.agent_messages.' .$message_inner_page_name)
                  </div>
                </div>
                @else
                  @include('customer.agent_messages.' .$message_inner_page_name)
                @endif

                @if(isset($current_message_thread_code) & $current_message_thread_code != '')
                <!-- Message Sending option & File -->
                <form method="post" action="{{ route('agentReplyMessage', ['param1' => $current_message_thread_code]) }}" class="needs-validation" novalidate name="chat-form" id="chat-form">
                  @csrf
                  <div class="message-send-option d-flex align-items-center flex-wrap g-20 pt-40">
                    <!-- Text Message -->
                    <div class="message-input d-flex justify-content-start align-items-center">
                      <input type="text" placeholder="Type a Message"  class="form-control eForm-control"
                        name="message" id="message"/>
                      <button type="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                      </button>
                    </div>
                  </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('customerjs')
<script>

  "use strict";

  @if(isset($current_message_thread_code) && $current_message_thread_code != '')
  
    $(document).ready(function() {

    $('#scroll').scrollTop($('#scroll').height());

    setInterval(function() {

      var messageBodyHeight = $('#scroll').height();
        
      var message_thread_code = '<?= $current_message_thread_code ?>';
      let url = "{{ route('getAgentSingleMassege', ['param1' => ":message_thread_code"]) }}";
      url = url.replace(":message_thread_code", message_thread_code);
      $.ajax({
      url: url,
      success:function(data)
      {
        $('#scroll').append(data);

      }
      });
    }, 5000);
  });
  @endif
</script>
@endsection
