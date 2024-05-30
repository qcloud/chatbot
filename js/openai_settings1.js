(function($) {

 $(document).ready(function () {
    var flieElementOpenAi = document.getElementById("openfileinput");

    if(flieElementOpenAi){
        $('.error-message').hide();
        $('.success-message').hide();
        $(".file_form").on('change','#openfileinput',function(){
            var file_data = $('#openfileinput').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('action', 'openai_file_upload');
            form_data.append('purpose','answers');
            $('.success-message').html('File is Proccesing');
            $('.success-message').show();
            $.ajax({
                url: openai_ajax.url,
                type: 'post',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    console.log(response[0].status)
                    if(response[0].status == "success"){
                       // $('.success').html(response.message)
                        $('.success-message').hide();
                        $('.success-message').html(response[0].message);
                        $('.success-message').show();
                        setTimeout(function(){
                            $('.success-message').hide();
                        },5000); 
                        location.reload();
                    }
                    if(response[0].status === "error"){
                        console.log(response[0].status)
                        //$('.success-message').html(response.message)
                        jQuery('.success-message').hide();
                        jQuery('.error-message').show();
                        jQuery('.error-message').html(response[0].message);
                        setTimeout(function(){
                            jQuery('.error-message').hide();
                        },5000); 
                        location.reload();
                    }
                },  
            });
            
        });

        $("#openaiFileList").on('click','.remove_file_openai',function(){
            $(this).hide();
            var file_id = $('.remove_file_openai').attr('data-id');
             jQuery('.error-message').show();
                jQuery('.error-message').html(file_id+'is deleting');
                setTimeout(function(){
                    jQuery('.error-message').hide();
                },5000); 
            $.ajax({
                url: openai_ajax.url,
                type: 'POST',
                dataType: "JSON",
                data:  {
                    action : 'openai_file_delete',
                    file_id: file_id
                },
                success: function (response) {
                    location.reload();
                },  
            });
            
        });
        $.ajax({
            url: openai_ajax.url,					
            type: "POST",
            dataType: "JSON",
            data: {
                action : 'openai_file_list',
            },
            success: function(res) {
                if((res.data != undefined)){
                    data = res.data;
                    let text = "";
                    data.forEach(itemfunction);
                    function itemfunction(item) {
                        text += '<tr><td>'+item.filename +'</td><td>' +item.id+'</td><td><a class="btn-success btn floated create_ft_model_modal" data-id="'+item.id+'">Create FT Model</a> <a class="btn-danger btn floated remove_file_openai" data-id="'+item.id+'">Remove</a></td></tr>';
                    }
                    document.getElementById("openaiFileList").innerHTML = text;
                }
            }
        });
    }
  
   
    
    // $('').on('click', '#save_setting', function(){
  
      
    // })
    var file_save = document.getElementById("save_file_id");
    if(file_save){
        $('.qcl-openai').on('click', '#save_file_id', function(){
            var file_id = $("input[name='file_id']" ).val();
            $.ajax({
                url:     openai_ajax.url,
                type:'POST',
                data:    ({action  : 'openai_settings_option',file_id:file_id}),
                success: function(data){
                    $('#result').html(data);
                 //   location.reload();
                }
            });
        })
    }
    var settingsOpenAi = document.getElementById("save_setting");
    if(settingsOpenAi){
        document.getElementById("temperature").onchange = function() {
            var x = document.getElementById("temperature");
            x.value = x.value.toUpperCase();
            updateTemp( x.value);
        };
        function updateTemp(n){
            document.getElementById('temperatureout').textContent=n; 
        };
        document.getElementById("frequency_penalty").onchange = function() {
            var x = document.getElementById("frequency_penalty");
            x.value = x.value.toUpperCase();
            updateFpenalty( x.value);
        };
        function updateFpenalty(n){
            document.getElementById('frequency_penalty_out').textContent=n; 
        };
        document.getElementById("presence_penalty").onchange = function() {
            var x = document.getElementById("presence_penalty");
            x.value = x.value.toUpperCase();
            updatePpenalty( x.value);
        };
        function updatePpenalty(n){
            document.getElementById('presence_penalty_out').textContent=n; 
        };
    
        $('.qcl-openai').on('change','#qcld_openai_prompt', function() {
          
            if( ($("[id*='qcld_openai_prompt'] :selected").val()) == 'custom_prompt'){
                console.log(this.value)
                $('#custom_prompt_wrapper').html('<input type="field" id="qcld_openai_prompt_custom" class="form-control my-2" placeholder="Add custom prompt here. Custom prompt will be appended before the user`s queries"/>');
            }else{
                $('#custom_prompt_wrapper').empty('')
            }
        })
        setTimeout(() => {
            var custom_promt_value =$("#custom_promt_value").val();
            if( $("[id*='qcld_openai_prompt'] :selected").val() == 'custom_prompt' ){
              
               // $("#custom_promt_value").filter('[value=any_command]').prop('selected', true);
                $('select option[value="custom_prompt"]').attr('selected', 'selected');
               // $('select option[value="any_command"]').attr('selected', 'selected');
              
                $('#custom_prompt_wrapper').html('<input type="field" id="qcld_openai_prompt_custom" class="form-control my-2" />');
                $('#qcld_openai_prompt_custom').val(custom_promt_value)
               
            }
        }, 500);
        $('.qcl-openai').on('click', '#save_setting', function(){
            console.log('ss')
            if ($('#is_ai_enabled').is(":checked")){
                var is_ai_enabled = 1;
            }else{
                var is_ai_enabled = 0;
            }
            if($('#is_ai_only_mode').is(":checked")){
                var is_ai_only_mode = 1; 
            }else{
                var is_ai_only_mode = 0;
            }
            var api_key = $( "input[name='api_key']" ).val();
            var openai_engines = $("[id*='openai_engines'] :selected").val();
            var qcld_openai_prompt = $("[id*='qcld_openai_prompt'] :selected").val();
            var max_tokens = $("input[name='max_tokens']" ).val();
            var file_id = $("input[name='file_id']" ).val();
            var temperature = $("input[name='temperature']" ).val();
            var presence_penalty = $("input[name='presence_penalty']" ).val();
            if(qcld_openai_prompt == "custom_prompt"){
                var qcld_openai_prompt_custom =  $("#qcld_openai_prompt_custom").val();
                console.log(qcld_openai_prompt)
            }
            var frequency_penalty = $("input[name='frequency_penalty']" ).val();
            $.ajax({
                url: openai_ajax.url,
                type:'POST',
                data:    ({action  : 'openai_settings_option',api_key: api_key,openai_engines:openai_engines,qcld_openai_prompt: qcld_openai_prompt,max_tokens:max_tokens,file_id:file_id,temperature:temperature,presence_penalty:presence_penalty,frequency_penalty:frequency_penalty,qcld_openai_prompt_custom: qcld_openai_prompt_custom,openai_exclude_keyword:openai_exclude_keyword,is_relevant_enabled:is_relevant_enabled,openai_include_keyword:openai_include_keyword,ai_enabled:is_ai_enabled,ai_only_mode: is_ai_only_mode}),
                success: function(data){
                    $('#result').html(data);
                   // location.reload();
                }
        });

        })
    }

    });


})(jQuery);