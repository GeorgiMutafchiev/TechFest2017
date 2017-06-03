<form class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<div class="col-md-12">
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="fromDate">Дата на пристигане</label>
								<input name="fromDate" type="date" class="form-control" id="fromDate" placeholder="Дата на пристигане" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="toDate">Дата на заминаване</label>
								<input name="toDate" type="date" class="form-control" id="toDate" placeholder="Дата на заминаване" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="roomtype">Тип стая</label>
								<select name="roomtype" class="form-control" id="roomtype">
  <optgroup label="ROOMS" style="color: black;">
    <option value="Single Room">Единична стая</option>
    <option value="Double Room">Двойна стая</option>
    <option value="Triple Room">Тройна стая</option>
  </optgroup>
  <optgroup label="APARTMENTS" style="color: black;">
    <option value="Small Apartment">Малък апартамент</option>
    <option value="Panoramic Apartment">Панорамен апартамент</option>
    <option value="Presidental Apartment">Президентски апартамент</option>
  </optgroup>
</select>

							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="email">Имейл адрес</label>
								<input name="email" type="email" class="form-control" id="email" placeholder="Вашият имейл адрес">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="fullName">Пълно име</label>
								<input name="fullName" type="text" class="form-control" id="fullName" placeholder="Вашето име">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="fromDate">Резервирай</label>
							<input name="submit" type="submit" class="btn btn-default btn-block" value="РЕЗЕРВИРАЙ">
						</div>
					</div>
				</form>