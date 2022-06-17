jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z \s]+$/i.test(value);
}, "Please insert alphabets only."); 
    
jQuery.validator.addMethod("fullemail", function(value, element) {
    return this.optional(element) || /^((?!.*\.{2})(?!_*\_{2})[a-zA-Z0-9_\.])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
}, "Not a valid email");
    
jQuery.validator.addMethod("digitonly", function(value, element) {
    return this.optional(element) || /^([0-9])+$/i.test(value);
}, "Please insert digits only.");

jQuery.validator.addMethod("phoneten", function(value, element) {
    return this.optional(element) || /^([0-9]){10}$/i.test(value);
}, "Please enter valid phone number.");

jQuery.validator.addMethod("zipcode", function(value, element) {
    return this.optional(element) || /^([A-Z 0-9])+$/i.test(value);
}, "Not a valid zip code.");

jQuery.validator.addMethod("pancard", function(value, element) {
    return this.optional(element) || /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/.test(value);
}, "Please enter valid pan number.");

jQuery.validator.addMethod("adhar", function(value, element) {
    return this.optional(element) || /^\d{4}\s\d{4}\s\d{4}$/g.test(value);
}, "Please enter valid adhar number.");


jQuery.validator.addMethod("fdigitonly", function(value, element) {
    return this.optional(element) || /^\d*(\.\d{0,2})?$/ .test(value);
}, "Please insert integer or float digits only.");

jQuery.validator.addMethod("phonedigitonly", function(value, element) {
    return this.optional(element) || /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])[2-9]{2}[0-9]{8}?$/.test(value);
}, "Please insert valid mobile number.")


jQuery.validator.addMethod("skype_id", function(value, element) {
    return this.optional(element) || /^(([1-9a-zA-Z\._@]))+$/.test(value);
}, "Please insert valid skype id.");

jQuery.validator.addMethod("strong_password", function(value, element) {
    return this.optional(element) || /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[0-9a-zA-Z]{8,}$/.test(value);
}, "Password must be 8 charactor.");



$("#loginform #password1").keyup(function(){
var str = $("#password1").val();

var patt = new RegExp("^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])[a-zA-Z0-9@#$%^&+=]*$");
var res = patt.test(str);
if(res==false){

      }
   });


jQuery.validator.addMethod("ccvlength", function(value, element) {
    return this.optional(element) || /^([0-9]\d{2})$/i.test(value);
},"Enter a valid ccv no.");


$.validator.addMethod( "creditcard", function( value, element ) {
  if ( this.optional( element ) ) {
    return "dependency-mismatch";
  }

  // Accept only spaces, digits and dashes
  if ( /[^0-9 \-]+/.test( value ) ) {
    return false;
  }

  var nCheck = 0,
    nDigit = 0,
    bEven = false,
    n, cDigit;

  value = value.replace( /\D/g, "" );

  // Basing min and max length on
  // https://developer.ean.com/general_info/Valid_Credit_Card_Types
  if ( value.length < 13 || value.length > 19 ) {
    return false;
  }

  for ( n = value.length - 1; n >= 0; n-- ) {
    cDigit = value.charAt( n );
    nDigit = parseInt( cDigit, 10 );
    if ( bEven ) {
      if ( ( nDigit *= 2 ) > 9 ) {
        nDigit -= 9;
      }
    }

    nCheck += nDigit;
    bEven = !bEven;
  }

  return ( nCheck % 10 ) === 0;
}, "Please enter a valid credit card number." );

/* NOTICE: Modified version of Castle.Components.Validator.CreditCardValidator
 * Redistributed under the the Apache License 2.0 at http://www.apache.org/licenses/LICENSE-2.0
 * Valid Types: mastercard, visa, amex, dinersclub, enroute, discover, jcb, unknown, all (overrides all other settings)
 */
$.validator.addMethod( "creditcardtypes", function( value, element, param ) {
  if ( /[^0-9\-]+/.test( value ) ) {
    return false;
  }

  value = value.replace( /\D/g, "" );

  var validTypes = 0x0000;

  if ( param.mastercard ) {
    validTypes |= 0x0001;
  }
  if ( param.visa ) {
    validTypes |= 0x0002;
  }
  if ( param.amex ) {
    validTypes |= 0x0004;
  }
  if ( param.dinersclub ) {
    validTypes |= 0x0008;
  }
  if ( param.enroute ) {
    validTypes |= 0x0010;
  }
  if ( param.discover ) {
    validTypes |= 0x0020;
  }
  if ( param.jcb ) {
    validTypes |= 0x0040;
  }
  if ( param.unknown ) {
    validTypes |= 0x0080;
  }
  if ( param.all ) {
    validTypes = 0x0001 | 0x0002 | 0x0004 | 0x0008 | 0x0010 | 0x0020 | 0x0040 | 0x0080;
  }
  if ( validTypes & 0x0001 && /^(5[12345])/.test( value ) ) { // Mastercard
    return value.length === 16;
  }
  if ( validTypes & 0x0002 && /^(4)/.test( value ) ) { // Visa
    return value.length === 16;
  }
  if ( validTypes & 0x0004 && /^(3[47])/.test( value ) ) { // Amex
    return value.length === 15;
  }
  if ( validTypes & 0x0008 && /^(3(0[012345]|[68]))/.test( value ) ) { // Dinersclub
    return value.length === 14;
  }
  if ( validTypes & 0x0010 && /^(2(014|149))/.test( value ) ) { // Enroute
    return value.length === 15;
  }
  if ( validTypes & 0x0020 && /^(6011)/.test( value ) ) { // Discover
    return value.length === 16;
  }
  if ( validTypes & 0x0040 && /^(3)/.test( value ) ) { // Jcb
    return value.length === 16;
  }
  if ( validTypes & 0x0040 && /^(2131|1800)/.test( value ) ) { // Jcb
    return value.length === 15;
  }
  if ( validTypes & 0x0080 ) { // Unknown
    return true;
  }
  return false;
}, "Please enter a valid credit card number." );