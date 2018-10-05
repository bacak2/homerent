
<div id="writeToUsPopup">
    <div>
        <span id="writeToUsClose" style="position: absolute; top: 18px; right: 18px; font-weight: bold; font-size: 18px">x</span>
        {!! Form::open(array('route' => 'aboutUs.SendMail', 'method' => 'post', 'class' => 'font-14', 'file' => 'true', 'enctype'=>"multipart/form-data")) !!}
            <div style="font-size: 24px; font-weight: bold;">{{ __('messages.Write to us') }}</div>
            <div class="pb-3 mb-3" style="border-bottom: 1px dashed black">{{ __('messages.Fields marked with an asterisk are mandatory.') }}</div>
            <div class="row mb-5">
                <div class="col-12 col-md-6">
                    <label for="contactEmail" class="bold">{{ __('messages.Your email address') }}:*</label>
                    <input id="contactEmail" name="contactEmail" style="width: 100%;" type="email" required="required" oninvalid='setCustomValidity("{{ __('messages.Enter valid email address') }}")'  oninput='setCustomValidity("")'>
                </div>
                <div class="col-12 col-md-6">
                    <label for="contactPhone" class="bold">{{ __('messages.Cellphone') }}:</label>
                    <input id="contactPhone" name="contactPhone" style="width: 100%;" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="reason" class="bold">{{ __('messages.Applicable') }}</label>
                    <div class="form-group row input-none-apartment-kind px-3">
                          <div class="rItem pr-2" style="padding: 0px;">
                                <input id="type0" type="radio" value="0" name="reason"><label for="type0" style="width: 100%"><div id="reason0" class="font-13 opinion-rItem" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><div>{{ __('messages.Traveler') }}</div></div></label>
                          </div>
                          <div class="rItem pr-2" style="padding: 0px;">
                                <input id="type1" type="radio" value="1" name="reason"><label for="type1" style="width: 100%"><div id="reason1" class="font-13 opinion-rItem" style="padding: 1px 8px 1px 8px;border-radius: 5px;"><div>{{ __('messages.Owner') }}<br>{{ __('messages.of object') }}</div></div></label>
                          </div>
                          <div class="rItem pr-2" style="padding: 0px;">
                                <input id="type2" type="radio" value="2" name="reason"><label for="type2" style="width: 100%"><div id="reason2" class="font-13 opinion-rItem" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><div>{{ __('messages.Other') }}</div></div></label>
                          </div>
                          <div class="rItem" style="padding: 0px;">
                                <input id="type3" type="radio" value="3" name="reason"><label for="type3" style="width: 100%"><div id="reason3" class="font-13 opinion-rItem" style="padding: 8px; border-radius: 5px;"><img style="margin-right: 0px;" src='{{ asset("images/contact/flag.png") }}'></div></label>
                          </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <select id="reasonSelect" style="display: none; width: 100%; margin-top: 40px">
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div id="maybeHelpful" style="display: none" class="col-12 col-md-6">
                    {{ __('messages.It may be helpful to read') }}:
                </div>
                <div id="faqLink" style="display: none" class="col-12 col-md-6">
                    <a href="#">{{ __('messages.I forgot my password - how to regain access') }}?</a>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="contactMessage" class="bold">{{ __('messages.Content') }}</label>
                    <textarea id="contactMessage" name="contactMessage" style="width: 100%; height: 95px" placeholder="{{ __('messages.Message content') }}"></textarea>
                </div>
            </div>
            <div id="attachments" class="pb-3 mb-3" style="border-bottom: 1px dashed black">
                <label id="addNewAttachment" for="files-upload" class="txt-blue">{{ __('messages.Add attachment') }}</label>
            </div>
            <div style="position: relative; height: 40px">
                <input style="position: absolute; left: 50%; transform: translateX(-50%); width: 182px" class="btn btn-black" type="submit" value="{{ __('messages.Send') }}">
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    $("#writeToUsClose").click(function() {
        $("#writeToUsPopup").hide();
    });

    $(".writeToUsOpen").click(function() {
        $("#writeToUsPopup").show();
    });

    $(".opinion-rItem").click(function(){
        $(".opinion-rItem").removeClass('selected');
        $(this).addClass('selected');
        changeOptions(this.id);
    });

    $("#addNewAttachment").click(function(){
        $("#attachments").append('<input class="d-block" type="file" name="file[]" multiple="multiple">');
    });

    $("#reasonSelect").change(function() {
        changeLinks($("#reasonSelect").val());
    });

    function changeOptions(reason) {
        $("#faqLink").hide();
        $("#maybeHelpful").hide();

        if(reason == 'reason0'){
            $("#reasonSelect").show().html('<option value="0">{{ __('messages.Choose') }}</option>\n' +
                '<option value="1">{{ __('messages.I have issue with login') }}</option>\n' +
                '<option value="2">{{ __('messages.How can i pay for reservation') }}</option>\n' +
                '<option value="3">Lorem ipsum</option>'
            );
        }
        else if(reason == 'reason1'){
            $("#reasonSelect").show().html('<option value="0">{{ __('messages.Choose') }}</option>\n' +
                '<option value="4">Lorem ipsum</option>\n' +
                '<option value="5">Lorem ipsum</option>\n' +
                '<option value="6">Lorem ipsum</option>'
            );
        }
        else if(reason == 'reason2'){
            $("#reasonSelect").show().html('<option value="0">{{ __('messages.Choose') }}</option>\n' +
                '<option value="7">Lorem ipsum</option>'
            );
        }
        else if(reason == 'reason3'){
            $("#maybeHelpful").hide();
            $("#reasonSelect").hide();
            $("#faqLink").show().html('{{ __('messages.Concerns opinion') }}: <span class="txt-blue">{{ __('messages.The beginning of the statement') }}</span>');
        }

    }

    function changeLinks(reasonDetail){
        switch(reasonDetail){
            case '1':
                link = '<a href="{{route('aboutUs.faq', 1).'#faq'}}">{{ __('messages.I forgot my password - how to regain access') }}?</a>';
            break;
            case '2':
                link = '<a href="{{route('aboutUs.faq', 2).'#faq'}}">{{ __('messages.How can i pay for reservation') }}?</a>';
            break;
            default:
                link = '<a href="{{route('aboutUs.faq', 3).'#faq'}}">{{ __('messages.help') }}</a>';
            break;

        }
        $("#maybeHelpful").show();
        $("#faqLink").show().html(link);
    }

    @if(isset($idComment))
        $(".writeToUsOpen").click();
        $("#reason3").click();
        $("#faqLink span").text('{{$commentToReport}}');
    @endif

</script>