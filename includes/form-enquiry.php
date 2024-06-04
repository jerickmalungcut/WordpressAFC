<!-- Success message submitted -->
<div class="hidden" id="success_message"></div>


<form class="flex flex-col gap-4 max-w-52" id="enquiry">
    <h2>Send an inquiry about <?php the_title(); ?></h2>

    

    <input type="hidden" name="registration" value="<?php the_field('registration'); ?>">

    <div class="form-group">
        <div class="flex flex-col">
            <input type="text" name="fname" placeholder="First Name" required class="border border-black p-2">
            <input type="text" name="lname" placeholder="Last Name" required class="border border-black p-2">
        </div>
    </div>

    <div class="form-group">
        <div class="">
            <input type="email" name="email" placeholder="Email Address" required class="border border-black p-2">
            <input type="tel" name="phone" placeholder="Telephone Number" required class="border border-black p-2">
        </div>
    </div>

    <textarea name="message" class="border border-black" placeholder="Input Message">
    
    </textarea>

    <button type="submit">Submit</button>
</form>

<script>
    (function($){
        $('#enquiry').submit(function(e) {
            e.preventDefault();
            var endpoint = '<?php echo admin_url('admin-ajax.php'); ?>';   
            var form = $('#enquiry').serialize();
            var formdata = new FormData;
            formdata.append('action', 'enquiry');
            formdata.append('nonce', '<?php echo wp_create_nonce('ajax-nonce'); ?>'); //This will secure the form
            formdata.append('enquiry', form);
            
            $.ajax(endpoint, {
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,

                success: function(res) {
                    $('#enquiry').fadeOut(200); // Hide the form upon successful submission

                    $('#success_message').text('Thanks for the inquiry').show();

                    $('#enquiry').trigger('reset'); //To reset/clear the form

                    $('#enquiry').fadeIn(500) //Shows the form after successful submission
                },
                error: function(err) {
                    // Added error handling to log errors to the console
                    console.error('An error occurred:', err);
                    alert(err.responseJSON.data);
                }
            })
         })
    })(jQuery)

    
</script>