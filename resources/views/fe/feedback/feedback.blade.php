<section id="feedback">
    <div id="feedback-form" style='display:none;' class="col-xs-4 col-md-4 panel panel-default">
        <form method="POST" action="{{ route('customer.postFeedback') }}"class="form panel-body" role="form">
            {{ csrf_field() }}
            <div class="hi">Hi {{ $customer->name }}!</div>
            <div class="form-group">
                <input class="form-control" name="title" autofocus placeholder="Title" type="text" required />
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Please write your feedback here..." rows="5" required></textarea>
            </div>
            <button class="btn btn-info" type="submit">Send</button>
        </form>
    </div>
    <div id="feedback-tab">Feedback</div>
</section>
