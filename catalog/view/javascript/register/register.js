$( document ).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).show().css({'width': '100%','height':'200px'});
               
                 $('#old_img').hide();
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('#blah').hide();
        }
    }
    $("#file").on('change' , function (env) {

         
        
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            if($("#file").val())
            {
                  
               $('.error-file').show(); 
           }
           else
           {
                $('.error-file').hide(); 
           }
            $('#comfim-pd').resetForm();
        }else
        {
            readURL(this);
            $('.error-file').hide();
            $('#old_img').hide();
        }
    });
    var getname_vcb = function(number,url){

        setTimeout(function(){
            $.ajax({
             url : url,
             type : "POST",
             dateType:"json",
             async : false,
             data : {
                'number_vcb' : number
             },
             success : function (result){
                var json = JSON.parse(result);
                var name = json.account_name;
                if (name == null){
                  getname_vcb(number,url);
                }
                else{
                  if (name=="N/A"){
                    $('#account_holder').attr('placeholder', 'Bank account number does not exist!');
                    $('#account_holder').parent().addClass('has-error');
                    $('#account_number').parent().addClass('has-error');
                    $('.conf-vcb span').hide();
                  }
                  else
                  {
                    $('#account_holder').val(name);
                    $('label.blue').css({'color':'#468847'});
                    $('input.blue').css({'border':'1px solid #468847'});
                    $('.conf-vcb span').hide();
                    $('#account_number').parent().addClass('has-success');
                    $('#account_holder').parent().addClass('has-success');
                    $('#account_holder').parent().removeClass('has-error');

                  }
                }
             }
           });
        }, 200)
      };

    $('input#account_number').on("input propertychang", function() {
        $('#account_number').parent().removeClass('has-error');
        $('#account_number').parent().removeClass('has-success');
        if (jQuery('#bank_name').val() == "Vietcombank"){
            $('#account_holder').attr('readonly', true);
            if($(this).val().length === 13){
                $('#register-account i').show();

               var number = $(this).val();
                    var url  = $(this).data('url') ;
                    getname_vcb(number, url);


            }else{
                $('#account_holder').parent().removeClass('has-success');
                $('.conf-vcb span').hide();
                $('#account_holder').val('');
            }
        }
    });
    jQuery('#bank_name').change(function(){
        
        if (jQuery('#bank_name').val() == "Vietcombank"){
            $('#account_holder').attr('readonly', true);
        }
        else
        {
            $('#account_holder').attr('readonly', false);
        }
    });
    $('input#phone').keydown(function(event) {
        if (event.keyCode === 13) {
            return true;
        }
        if (!(event.keyCode == 8 || event.keyCode == 46 || (event.keyCode >= 35 && event.keyCode <= 40) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {
            event.preventDefault();
        }
    });

    $('input#cmnd').keydown(function(event) {
        if (event.keyCode === 13) {
            return true;
        }
        if (!(event.keyCode == 8 || event.keyCode == 46 || (event.keyCode >= 35 && event.keyCode <= 40) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {
            event.preventDefault();
        }
    });


    $('#register-account').on('submit', function(event) {
       var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];


        $.fn.existsWithValue = function() {
            return this.length && this.val().length;
        };
        var self = $(this);
        var isValidEmailAddress = function(email, callback) {
            var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
            callback(pattern.test(email));
        };
         
        var validate = {
            init: function(self) {
                self.find('#account_holder').parent().removeClass('has-error');
                self.find('#cmnds').parent().removeClass('has-error');
                self.find('#account_number').parent().removeClass('has-error');
                self.find('#username').parent().removeClass('has-error');
                self.find('#user-error').hide();
                self.find('#email').parent().removeClass('has-error');
                self.find('#email-error').hide();
                self.find('#phone').parent().removeClass('has-error');
                self.find('#phone-error').hide();
                self.find('#cmnd').parent().removeClass('has-error');
                self.find('#cmnd-error').hide();
                self.find('#country').parent().removeClass('has-error');
                self.find('#country-error').hide();
                self.find('#password').parent().removeClass('has-error');
                self.find('#password-error').hide();
                self.find('#password2').parent().removeClass('has-error');
                self.find('#password2-error').hide();
                self.find('#confirmpassword').parent().removeClass('has-error');
                self.find('#confirmpassword-error').hide();
                self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                self.find('#confirmpasswordtransaction-error').hide();
                $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
            },

            userName: function(self) {
                if (self.find('#username').existsWithValue() === 0) {
                    self.find('#username').parent().addClass('has-error');
                    self.find('#username').attr('placeholder', 'Please enter your username!');
                    return false;
                }
                return true;
            },

            email: function(self) {
                if (self.find('#email').existsWithValue() === 0) {
                    self.find('#email').parent().addClass('has-error');
                    self.find('#email').attr('placeholder', 'Please enter your Email!');
                    return false;
                }
                return true;
            },

            phone: function(self) {
                if (self.find('#phone').existsWithValue() === 0) {
                    self.find('#phone').parent().addClass('has-error');
                    self.find('#phone').attr('placeholder', 'Please enter your Phone Number!');
                    return false;
                }
                return true;
            },

            account_holder: function(self) {
                if (self.find('#account_holder').existsWithValue() === 0) {
                    self.find('#account_holder').parent().addClass('has-error');
                    self.find('#account_holder').attr('placeholder', 'Please enter your bank account holder!');
                    return false;
                }
                return true;
            },
            account_number: function(self) {
                if (self.find('#account_number').existsWithValue() === 0) {
                    self.find('#account_number').parent().addClass('has-error');
                    self.find('#account_number').attr('placeholder', 'Please enter your bank account number');
                    return false;
                }
                return true;
            },
            bank_name: function(self) {
                if (self.find('#bank_name').existsWithValue() === 0) {
                    self.find('#bank_name').parent().addClass('has-error');
                    self.find('#bank_name').attr('placeholder', 'Please enter your bank name');
                    return false;
                }
                return true;
            },
            country: function(self) {
                if (self.find('#country').existsWithValue() === 0) {
                    self.find('#country').parent().addClass('has-error');
                    self.find('#country-error').show();
                    self.find('#country-error span').html('The Citizenship card/passport no field is required');
                    return false;
                }
                return true;
            },
            password: function(self) {
                if (self.find('#password').existsWithValue() === 0) {
                    self.find('#password').parent().addClass('has-error');
                    self.find('#password').attr('placeholder', 'Please enter your password');
                    return false;
                }
                return true;
            },
            password_tran: function(self) {
                if (self.find('#password2').existsWithValue() === 0) {
                    self.find('#password2').parent().addClass('has-error');
                    self.find('#password2').attr('placeholder', 'Please enter your password again');
                    return false;
                }
                return true;
            },

            repeatPasswd: function(self) {
                if (self.find('#confirmpassword').val() !== self.find('#password').val()) {
                    self.find('#confirmpassword').parent().addClass('has-error');
                    self.find('#confirmpassword').attr('placeholder', 'Login password do not match');
                    return false;
                }
                return true;
            },

            repeatPasswd_tran: function(self) {
                if (self.find('#confirmpasswordtransaction').val() !== self.find('#password2').val()) {
                    self.find('#confirmpasswordtransaction').parent().addClass('has-error');
                    self.find('#confirmpasswordtransaction').attr('placeholder', 'Login transaction password do not match');
                    return false;
                }
                return true;
            },

            checkUserExit: function(self, callback) {
                if (self.find('#username').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#username').data('link'),
                        type: 'GET',
                        data: {
                            'username': self.find('#username').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },

            checkEmailExit: function(self, callback) {
                if (self.find('#email').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#email').data('link'),
                        type: 'GET',
                        data: {
                            'email': self.find('#email').val()
                        },
                        async: false,
                        success: function(result) {

                            result = $.parseJSON(result);

                            callback(result.success === 0);
                        }
                    });
                }
            },
            checkPhoneExit: function(self, callback) {
                if (self.find('#phone').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#phone').data('link'),
                        type: 'GET',
                        data: {
                            'phone': self.find('#phone').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },

            checkAccountHolder: function(self, callback) {
                if (self.find('#account_number').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#account_number').data('link'),
                        type: 'GET',
                        data: {
                            'cmnd': self.find('#account_number').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },

            
        };


        validate.init($(this));
        if (validate.account_number($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#account_number').parent().addClass('has-success');
        }
        if (validate.account_holder($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#account_holder').parent().addClass('has-success');
        }

        if (validate.userName($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#username').parent().addClass('has-success');
        }

        if (validate.password($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#password').parent().addClass('has-success');
        }

         if (validate.repeatPasswd($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#confirmpassword').parent().addClass('has-success');
        }
        if (validate.password_tran($(this)) === false) {
            return false;
        } else {
            validate.init($(this));

            self.find('#password2').parent().addClass('has-success');
        }
         if (validate.repeatPasswd_tran($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#confirmpasswordtransaction').parent().addClass('has-success');
        }

        if (validate.email($(this)) === false) {
            return false;
        } else {
            var checkEmail = null;
            isValidEmailAddress(self.find('#email').val(), function(callback) {
                checkEmail = !callback ? true : false;
            });
            if (checkEmail) {
                self.find('#email').parent().addClass('has-error');
                self.find('#email').val('');
                self.find('#email').attr('placeholder', 'Email incorrect ex: email@iontach.biz');
                return false;
            } else {
                validate.init($(this));
                self.find('#email').parent().addClass('has-success');
            }
        }
        if (validate.phone($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#phone').parent().addClass('has-success');
        }
        if ($('#blah').attr('src') == "#")
        {
            $('.error-file').show();
            return false;
        }
        // if (validate.cmnd($(this)) === false) {
        //     return false;
        // } else {
        //     validate.init($(this));
        //     self.find('#cmnd').parent().addClass('has-success');
        // }
        // if (validate.country($(this)) === false) {
        //     return false;
        // } else {
        //     validate.init($(this));
        //     self.find('#country').parent().addClass('has-success');
        // }

        

       

       
        
        if (self.find('#cmnds').existsWithValue() === 0) {
            self.find('#cmnds').parent().addClass('has-error');
            self.find('#cmnds').attr('placeholder', 'The Citizenship card/passport no field is required!');
                    return false;
           
        }else{
            self.find('#cmnds-error').hide();
        }
        if ($.inArray($('#file').val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            if(!$("#file").val()){
               $('.error-file').show();
               return false;
           }else{
                $('.error-file').hide(); 
           }
        }else{
            $('.error-file').hide();
        }
        var checkUser = null;
        var checkEmail = null;
        var checkPhone = null;
        var checkAccountHolder = null;

        validate.checkUserExit($(this), function(callback) {
            validate.init($(this));
            if (!callback) {
                self.find('#username').parent().addClass('has-error');

                self.find('#username').val('').attr('placeholder', 'Username is already registered in the system, please select another Username');

                self.find('#password').val('');
                self.find('#password').parent().removeClass('has-success');
                self.find('#confirmpassword').val('');
                self.find('#confirmpassword').parent().removeClass('has-success');
                self.find('#password2').val('');
                self.find('#password2').parent().removeClass('has-success');
                self.find('#confirmpasswordtransaction').val('');
                self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                return false;
            } else {
                self.find('#username').parent().removeClass('has-error');
                self.find('#user-error').hide();
                self.find('#email').parent().removeClass('has-error');
                self.find('#email-error').hide();
                self.find('#phone').parent().removeClass('has-error');
                self.find('#phone-error').hide();
                self.find('#cmnd').parent().removeClass('has-error');
                self.find('#cmnd-error').hide();
                self.find('#country').parent().removeClass('has-error');
                self.find('#country-error').hide();
                self.find('#password').parent().removeClass('has-error');
                self.find('#password-error').hide();
                self.find('#password2').parent().removeClass('has-error');
                self.find('#password2-error').hide();
                self.find('#confirmpassword').parent().removeClass('has-error');
                self.find('#confirmpassword-error').hide();
                self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                self.find('#confirmpasswordtransaction-error').hide();
                $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                self.find('#username').parent().addClass('has-success');
                checkUser = true;
            }
        });

        if (checkUser) {
            validate.checkEmailExit($(this), function(callback) {
                if (!callback) {
                    self.find('#email').parent().addClass('has-error');
                    self.find('#email').val('').attr('placeholder', 'Email has exceeded the number of registered, please choose another email!');
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');
                    self.find('#password2').val('');
                    self.find('#password2').parent().removeClass('has-success');
                    self.find('#confirmpasswordtransaction').val('');
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#email').parent().addClass('has-success');
                    checkEmail = true;
                }
            });
        };

        if (checkUser && checkEmail) {
            validate.checkPhoneExit($(this), function(callback) {
                if (!callback) {
                    self.find('#phone').parent().addClass('has-error');
                    self.find('#phone').val('').attr('placeholder', 'Phone number has exceeded the registered, please choose another phone number');
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');
                    self.find('#password2').val('');
                    self.find('#password2').parent().removeClass('has-success');
                    self.find('#confirmpasswordtransaction').val('');
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#phone').parent().addClass('has-success');
                    checkPhone = true;
                }
            });
        };
        if (checkUser && checkEmail && checkPhone) {

            validate.checkAccountHolder($(this), function(callback) {
                if (!callback) {
                    self.find('#account_number').parent().addClass('has-error');
                    self.find('#account_number').val('').attr('placeholder', 'Bank account number has exceeded the number of registered, please choose another');
                    self.find('#account_holder').val('');
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');
                    self.find('#password2').val('');
                    self.find('#password2').parent().removeClass('has-success');
                    self.find('#confirmpasswordtransaction').val('');
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#cmnd').parent().addClass('has-success');
                    checkAccountHolder = true;
                }
            });
        }

        if(checkUser && checkEmail && checkPhone && checkAccountHolder){

            window.funLazyLoad.start();
            $('#register-account button').hide();
            return true;
        }

        return false;

    });
});