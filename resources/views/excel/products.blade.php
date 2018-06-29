<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="{{ asset('public/css/excel.css') }}" rel="stylesheet" type="text/css">
	
</head>
<body>
<table>
	<tr class="row-title">
		<td class="col-title"> Mã SP </td>
		<td class="col-title"> Tên sản phẩm </td>
		<td class="col-title"> Giá gốc </td>
		<td class="col-title"> Giá bán </td>
		<td class="col-title"> Giá khuyến mãi </td>
		<td class="col-title"> Trọng lượng (Gram) </td>
	</tr>
	@forelse($data as $val)
	<tr class="row">
		<td class="col"> {{ $val->code }} </td>
		<td class="col"> {{ $val->title }} </td>
		<td class="col"> {{ $val->original_price }} </td>
		<td class="col"> {{ $val->regular_price }} </td>
		<td class="col"> {{ $val->sale_price }} </td>
		<td class="col"> {{ $val->weight }} </td>
	</tr>
	@empty
	@endforelse
</table>
</body>
</html>