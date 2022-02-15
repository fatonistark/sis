<div class="row">
	
	<div class="col-md-4">
		<div class="card text-white bg-dark">
			<div class="card-body">
				<h4 class="card-title text-white">Cari Santri ...</h4>
				<form id="form-search">
					<div class="form-group">
						<label>NIS</label>
						<input type="text" name="nis" class="form-control">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md" id="card-santri">
		<div class="card text-white bg-success">
			<div class="card-body">
				<div class="row">
					<div class="col-md">
						<h4 class="card-title text-white">Nama Lengkap : <span class="nama_lengkap"></span></h4>
						<h4 class="card-title text-white">NIS : <span class="nis"></span></h4>
					</div>

					<div class="col-md">
						<h1>Rp. <span class="walletamount"></span></h1>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>

<div class="row" id="card-checkout">
	<div class="col-md-4">
		<div class="card text-white bg-dark">
			<div class="card-body">
				<h4 class="card-title text-white">Scan Barcode ...</h4>
				<form id="form-search-item">
					<div class="form-group">
						<label>Barcode</label>
						<input type="text" name="barcode" class="form-control" required>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md">
		<div class="card">
			<form id="form-bills">
				<input type="hidden" name="nis" class="form-control">
				<input type="hidden" name="walletamount" class="form-control">
			
				<div class="card-header bg-info text-white">
					<div class="row">
						<div class="col-8">
							<h4>Chekout ...</h4>
						</div>

						<div class="col">
							<input type="hidden" id="total-item">
							<h4 class="float-right">
								Rp. <span class="total-amount number"></span>
							</h4>
						</div>
					</div>
				</div>

				<div class="card-body" id="card-item-checkout">
					
				</div>

				<input type="hidden" name="amount">
				<button class="btn btn-outline-info m-2" type="submit" form="form-bills"><i class="fas fa-cart-plus"></i> Chekout</button>
			</form>
		</div>
	</div>
</div>