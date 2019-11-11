<div id="notifications" style="display:none;">
    @if ($message = Session::get('danger'))
    <notifications message="{{ $message }}" active="true" type="danger" title="{{ trans('front.danger')}}" ></notifications>
    {{ Session::forget('danger') }}
    @endif
    @if ($message = Session::get('info'))
    <notifications message="{{ $message }}" active="true" type="info" title="{{ trans('front.info')}}" ></notifications>
    {{ Session::forget('info') }}
    @endif
    @if ($message = Session::get('warning'))
    <notifications message="{{ $message }}" active="true" type="warning" title="{{ trans('front.warning')}}" ></notifications>
    {{ Session::forget('warning') }}
    @endif
    @if ($message = Session::get('success'))
    <notifications message="{{ $message }}" active="true" type="success" title="{{ trans('front.success')}}" ></notifications>
    {{ Session::forget('success') }}
    @endif
</div>
<notifications message="message" active="false" type="success" title="title" ></notifications>
<confirmation></confirmation>
