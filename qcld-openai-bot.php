   
<div class="qcl-openai">
    <div class="row gx-0">
        <div class="col-xs-12">
            <div class="card admin-maxwith">
                <div class="card-header bg-dark text-white py-sm-4 border-0">
                    <div class="row">
                        <div class="col-auto me-auto">
                            <h4><?php esc_html_e( 'OpenAI Settings','openai_addon');?></h4> 
                        </div>
                        <div class="col-auto">
                             <!-- <img class="img-fluid" src="<?php //echo esc_url(QCLD_openai_addon_PLUGIN_URL.'image/logo.jpg'); ?>"/> -->
                        </div>
                    </div>
                </div>
                <div class="card-body p-sm-0">
                    <div class="row g-0">
                        <div class="p-sm-3 bg-dark rl-col-custom"></div>
                        <div class="col-sm-10">
                            <div class="form-check form-switch my-4">
                                <input class="form-check-input" type="checkbox" <?php echo esc_attr( (get_option( 'ai_enabled') == 1) ? 'checked' :'' );?>  role="switch" value="" id="is_ai_enabled">
                                <label class="form-check-label" for="is_ai_enabled">
                                <?php  esc_html_e( 'Enable Open AI','openai_addon');?>
                                </label>
                            </div>
                            <div class="form-check form-switch my-4">
                                <input class="form-check-input" type="checkbox" <?php echo esc_attr( (get_option( 'ai_only_mode') == 1) ? 'checked' :'');?>  role="switch" value="" id="is_ai_only_mode">
                                <label class="form-check-label" for="is_ai_only_mode">
                                <?php  esc_html_e( 'Enable OpenAI only mode and hide other chatBot features','openai_addon');?>
                                </label>
                            </div>
                            <div class="mb-3">
                                    <label for="api_key" class="form-label"><?php esc_html_e( 'Api key','openai_addon');?></label>
                                    <input type="text" class="form-control" id="api_key" name="api_key" placeholder="Api key" value="<?php echo esc_attr( get_option( 'open_ai_api_key') ); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="max_tokens" class="form-label"><?php esc_html_e( 'Max tokens (0-4000) Depending on the model','openai_addon');?></label>
                                <input id="max_tokens" class="form-control" type="text" name="max_tokens" value="<?php echo esc_attr( get_option( 'openai_max_tokens') ); ?>">
                            </div>
                            <div class="mb-3">
                                <div class="row gx-0"><div class="col-8"><label for="temperature" class="form-label"><?php esc_html_e( 'Temperature','openai_addon');?></label></div><div class="col-4 me-auto text-end"><span name="temperatureout" id="temperatureout" ><?php echo esc_html( get_option( 'openai_temperature') ); ?></span></div></div>
                                <input id="temperature" type="range" class="form-range" min="0" max="1" step="0.01" name="temperature" value="<?php echo esc_attr( get_option( 'openai_temperature') ); ?>"  onchange="updateTemp(this.value);" />
                                <label class="mb-3"><small><?php  esc_html_e( 'Temperature is a value between 0 and 1 that essentially lets you control how confident the model should be when making these predictions','openai_addon');?></small></label>
                                <span name="temperatureout" id="temperatureout" ><?php // echo get_option( 'openai_temperature'); ?></span>
                            </div>
                            <div class="mb-3">
                                <div class="row gx-0"><div class="col-8"><label for="presence_penalty" class="form-label"><?php esc_html_e( 'Presence Penalty','openai_addon');?></label></div><div class="col-4 me-auto text-end"><span id="presence_penalty_out" ><?php echo esc_html( get_option( 'presence_penalty') ); ?></span></div></div>
                                <input id="presence_penalty" type="range" class="form-range" min="-2" max="2" step="0.1" name="presence_penalty" value="<?php echo esc_attr( get_option( 'presence_penalty') ); ?>">
                                <p class="mb-3"><small><?php  esc_html_e( 'Number between -2.0 and 2.0. Positive values penalize new tokens based on whether they appear in the text so far, increasing the model’s likelihood to talk about new topics.','openai_addon');?></small></p>
                            </div>
                            <div class="mb-3">
                                <div class="row gx-0"><div class="col-8"><label for="frequency_penalty" class="form-label"><?php esc_html_e( 'Frequency penalty','openai_addon');?></label></div><div class="col-4 me-auto text-end"><span id="frequency_penalty_out" ><?php echo esc_html( get_option( 'frequency_penalty') ); ?></span></div></div>
                                <input id="frequency_penalty" type="range" class="form-range" min="-2" max="2" step="0.1" name="frequency_penalty" value="<?php echo esc_attr( get_option( 'frequency_penalty') ); ?>">
                                <label><small><?php  esc_html_e( 'Number between -2.0 and 2.0. Positive values penalize new tokens based on their existing frequency in the text so far, decreasing the model’s likelihood to repeat the same line verbatim.','openai_addon','openai_addon');?></small></label>
                            </div>
                           
                            <div class="mb-3">
                                <label for="max_tokens" id="openai_engines" class="form-label"><?php esc_html_e( 'Engines','openai_addon');?></label>
                                <select class="form-select" aria-label="Default select example" name="openai_engines" id="openai_engines">
                                    <option <?php echo esc_attr( ((get_option( 'openai_engines') == '') ? 'selected' : '') ); ?>><?php esc_html_e( 'Please select Engines','openai_addon');?></option>
                                    <option value="text-davinci-003" <?php echo esc_attr( ((get_option( 'openai_engines') == 'text-davinci-003') ? 'selected' : '') ); ?>><?php esc_html_e( 'Davinci (GPT-3 model)','openai_addon');?></option>
                                    <option value="text-davinci-001" <?php echo esc_attr( ((get_option( 'openai_engines') == 'text-davinci-001') ? 'selected' : '') ); ?>><?php esc_html_e( 'Davinci','openai_addon');?></option>
                                    <option value="text-ada-001" <?php echo esc_attr( ((get_option( 'openai_engines') == 'text-ada-001') ? 'selected' : '') ); ?>><?php esc_html_e( 'Ada','openai_addon');?></option>
                                    <option value="text-curie-001" <?php echo esc_attr( ((get_option( 'openai_engines') == 'text-curie-001') ? 'selected' : '') ); ?>><?php esc_html_e( 'Curie','openai_addon');?></option>
                                    <option value="text-babbage-001" <?php echo esc_attr( ((get_option( 'openai_engines') == 'text-babbage-001') ? 'selected' : '' ) ); ?>><?php esc_html_e( 'Babbag','openai_addon');?></option>
                                </select>
                            </div>
                        
                            <div class="mb-3">
                                
                                <label for="qcld_openai_prompt" class="form-label"><?php esc_html_e( 'Select Prompt','openai_addon');?></label>
                                <select class="form-select" aria-label="Default select example" name="qcld_openai_prompt" id="qcld_openai_prompt">
                                    <option <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == '') ? 'selected' : '') ); ?>><?php esc_html_e( 'Please select prompt','openai_addon');?></option>
                                    <option value="q_and_a" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'q_and_a') ? 'selected' : '') ); ?>><?php esc_html_e( 'Q & A','openai_addon');?></option>
                                    <option value="chat" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'chat') ? 'selected' : '') ); ?>><?php esc_html_e( 'Chat','openai_addon');?></option>
                                    <option value="friend_chat" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'friend_chat') ? 'selected' : '') ); ?>><?php esc_html_e( 'Friend Chat','openai_addon');?></option>
                                    <option value="grammar_correction" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'grammar_correction') ? 'selected' : '') ); ?>><?php esc_html_e( 'Grammar correction','openai_addon');?></option>
                                    <option value="marv_sarcastic_chatbot" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'marv_sarcastic_chatbot') ? 'selected' : '') ); ?>><?php esc_html_e( 'Marv the sarcastic chat bot','openai_addon');?></option>
                                    <option value="micro_horror" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'micro_horror') ? 'selected' : '') ); ?>><?php esc_html_e( 'Two-Sentence Horror Story:','openai_addon');?></option> 
                                    <option value="write_poem" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'write_poem') ? 'selected' : '') ); ?>><?php esc_html_e( 'Write a poem (in English)','openai_addon');?></option>
                                    <option value="any_command" <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'any_command') ? 'selected' : '') ); ?>><?php esc_html_e( 'Any command','openai_addon');?></option>
                                    <option value="custom_prompt"  <?php echo esc_attr( ((get_option( 'qcld_openai_prompt') == 'custom_prompt') ? 'selected' : '') ); ?>><?php esc_html_e( 'Custom prompt will be appended before the user`s queries','openai_addon');?></option>
                                </select>
                                <div id="custom_prompt_wrapper">
                                    <input type="hidden" id="custom_promt_value" value="<?php echo esc_attr( get_option('qcld_openai_prompt_custom') ); ?>"/>
                                </div>
                                <p class="mb-3"><small><?php  esc_html_e( 'Please Select a prompt. The default value of the prompt is Q&A','openai_addon');?></small></p>
                            </div>

                            <a class="btn btn-success" id="save_setting"><?php esc_html_e( 'Save settings','openai_addon');?></a>
                        </div>
                        <div class="p-sm-3 bg-dark rl-col-custom ms-auto"></div>
                </div>
                <div class="card-footer bg-dark text-white py-sm-4 border-0"></div>
            </div>
        </div>
    </div>
</div>

