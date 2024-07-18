

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ @yield('title') }}</title>

    @section('styles')
        @vite(['resources/assets/scss/main.scss', 'resources/assets/ts/app.ts'])
    @show
</head>

<body class="body">
    <div class="app">
		<main class="page">
			<div class="container">
				<div class="row flex--justify-center flex--no-wrap">
					<div class="col-12 col-s-8 col-m-6">
						<h1 class="text__title spacer--mb-1">Aktivierungslink abgelaufen</h1>

						<p class="spacer--mb-1 text__small">Ihr Aktivierungslink für die Registrierung ist abgelaufen. Bitte klicken Sie auf den untenstehenden Link, um eine neue E-Mail zur Bestätigung Ihrer Registrierung zu erhalten. Überprüfen Sie anschließend Ihren Posteingang und folgen Sie den Anweisungen, um Ihr Konto zu aktivieren. Prüfen Sie auch Ihren Spam-Ordner</p>

						<form action="/verify/resend" novalidate method="POST">
							<input type="hidden" value="">
								<button class="btn btn--primary" href="">E-Mail erneut senden</button>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>

</html>
