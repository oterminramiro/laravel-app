@extends('emails.template')

@section('content')

<tr>
	<td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
		<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td style="padding: 0 2.5em; text-align: left;">
					<div class="text">
						<h2 style="font-weight:400; line-height:1.8;">Bienvenido a {{ $data['organization'] }}</h2>
						<h3>Tu turno en {{ $data['location'] }} esta confirmado</h3>
					</div>
				</td>
			</tr>
		</table>
	</td>
</tr>

@endsection
