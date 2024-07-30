@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-6 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">

							<!-- Tombol Scan Barcode -->
							<button class="btn btn-primary btn-lg" id="scanButton">
								<i class="bx bx-qr-scan"></i>
								Scan QR Code
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				{{-- QR Code Scanner --}}
				<div id="qr-reader" style="width:300px;"></div>
				<div id="qr-reader-results"></div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", () => {
			const resultContainer = document.getElementById('qr-reader-results');
			const lastResult = [];

			function onScanSuccess(decodedText, decodedResult) {
				if (!lastResult.includes(decodedText)) {
					lastResult.push(decodedText);
					const result = document.createElement('div');
					result.innerHTML = `<div>${decodedText}</div>`;
					resultContainer.appendChild(result);

					// Create a form and submit it
					const form = document.createElement('form');
					form.method = 'POST';
					form.action =
						'http://127.0.0.1:8000/scanqrcode'; // Replace with your local server URL

					const csrfTokenInput = document.createElement('input');
					csrfTokenInput.type = 'hidden';
					csrfTokenInput.name = '_token';
					csrfTokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

					const qrCodeInput = document.createElement('input');
					qrCodeInput.type = 'hidden';
					qrCodeInput.name = 'qr_code';
					qrCodeInput.value = decodedText;

					form.appendChild(csrfTokenInput);
					form.appendChild(qrCodeInput);
					document.body.appendChild(form);
					form.submit();
				}
			}

			document.getElementById("scanButton").addEventListener("click", () => {
				const html5QrCode = new Html5Qrcode("qr-reader");
				const config = {
					fps: 10,
					qrbox: 250
				};

				html5QrCode.start({
						facingMode: "environment"
					}, config, onScanSuccess)
					.catch(err => {
						console.error("Error starting QR scanner", err);
					});
			});
		});
	</script>
@endpush
