@extends('beautymail::templates.ark')

@section('content')

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Hello World!',
		'level' => 'h1'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hello World</strong></h4>
        <p>This is a test</p>
        <img src="https://serviceadept.me/assets/images/logo.svg" width="100px" height="100px" alt="nothing">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus nobis porro suscipit exercitationem nemo at aliquam corrupti beatae voluptatibus cum repudiandae temporibus, veniam velit expedita aspernatur impedit necessitatibus eaque officiis!

    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.heading', [
		'heading' => 'Another headline',
		'level' => 'h2'
	])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hello World again</strong></h4>
        <p>This is another test</p>

    @include('beautymail::templates.ark.contentEnd')

@stop