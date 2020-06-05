$(function (){
  $.validator.setDefaults( {
    submitHandler: function () {
    }
  });
  $('#sendEmailForm').validate({
    rules: {
      to: {
        required: true,
        isEmail: true
      },
      subject: 'required',
      body: {
        required: true
      }
    },
    messages: {
      to: 'Please enter a valid email address.',
      subject: 'Subject cannot be blank.',
    },
    errorElement: 'em',
    errorPlacement: function ( error, element ) {
      error.addClass( 'invalid-feedback' );
      if ( element.prop( 'type' ) === 'checkbox' ) {
        error.insertAfter( element.parent( 'label' ) );
      } else {
        error.insertAfter( element );
      }
    },
    highlight: function ( element, errorClass, validClass ) {
      $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
    },
    unhighlight: function (element, errorClass, validClass) {
      $( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' );
    }
  });
  jQuery.validator.addMethod("isEmail", function(email, element) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  });
});
