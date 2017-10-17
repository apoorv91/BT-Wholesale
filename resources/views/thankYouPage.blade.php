 @extends('layouts.app')

  @section('content')
  <div class="container">
    <div class="row">
      <div id="frame-mini" style="width:100%">
        <div class="node">
          <div class="content clear-block">

            <script type="text/javascript">
              if (typeof _gaq != 'undefined') _gaq.push(['_trackPageview', '/internet/thank-you']);
            </script>
            <div class="quoteSubHeader">Thank you</div>
            <br />
            <span class="bodyCopy">Your quote is being processed and will be emailed to  <b><?php echo $mail_email; ?></b> within the next few minutes.</span>
            <br /><br />
            <form method="POST" action="/service">
             <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
             <div>
              <input type="submit" class="BackgroundClass" name="restart" value="Start a fresh">&nbsp;
            </div>
          </form>

          <!-- Google Code for Quote submission Conversion Page -->
          <script type="text/javascript">
            /* <![CDATA[ */
            var google_conversion_id = 1066032713;
            var google_conversion_language = "en_GB";
            var google_conversion_format = "1";
            var google_conversion_color = "ffffff";
            var google_conversion_label = "8s92CKXvowEQybyp_AM";
            var google_conversion_value = 0;
            /* ]]> */
          </script>
          <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
          </script>
          <noscript>
            <div style="display:inline;">
              <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066032713/?value=0&amp;label=8s92CKXvowEQybyp_AM&amp;guid=ON&amp;script=0"/>
            </div>
          </noscript>     
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



