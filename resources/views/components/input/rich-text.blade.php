{{--<div--}}
{{--    class="rounded-md shadow-sm"--}}
{{--    x-data="{--}}
{{--        value: @entangle($attributes->wire('model')).live,--}}
{{--        isFocused() { return document.activeElement !== this.$refs.trix },--}}
{{--        setValue() { this.$refs.trix.editor.loadHTML(this.value) },--}}
{{--    }"--}}
{{--    x-init="setValue(); $watch('value', () => isFocused() && setValue())"--}}
{{--    x-on:trix-change="value = $event.target.value"--}}
{{--    {{ $attributes->whereDoesntStartWith('wire:model.live') }}--}}
{{--    wire:ignore--}}
{{-->--}}
<div>
    @trix(\App\Method::class, 'method')
</div>

