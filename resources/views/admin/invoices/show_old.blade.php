@extends('layouts.master')
@section('content')




<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Customer</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
        	<div class="card-header">
                <div class="row justify-content-end">
                	<div class="col-md-4 d-inline-flex justify-content-end">
						<a href="" class="btn btn-primary"><i class="bx bx-download"></i>Download</a>
                    </div>
              	</div>
            </div>
            <div class="card-body invoice_template">
                <div class="table-responsive">
	                <table class="table" style="width:840px;margin:0px auto;background-color:#f5f5f5">
						<tbody>
							<tr>
								<td>
									<table style="max-width:820px;padding:40px 40px 20px 40px;margin:0px auto;color: black;background-color:#fff;font-family: arial,sans-serif;border-collapse: collapse;font-size: 12px;">
										<tbody>
											<tr>
												<td style="padding: 15px;">
													<table>
														<thead>
															<tr>
																<td><b>Invoice ID : </b>{{$data->invoice_number}}</td>
																<td style="text-align: right;"><img src="{{ asset('assets/images/logo.png') }}" style="max-width: 200px;"></td>
															</tr>

															<tr>
																<td colspan="2" style="padding-top: 20px;">
																	<table style="border-collapse: collapse;width: 100%;">
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">TO</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 14px;">@foreach($client as $value){{$value->client_name}}@endforeach</span>
																				<!-- <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">It Business</span> -->
																			</td>	
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;font-size: 13px;">FROM</span>				
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">INVENTCO SOFTWARE PVT LTD</span>
																			</td>		
																		</tr>
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Address</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">@foreach($client as $value){{$value->client_address}}@endforeach</span>
																				<!-- <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">It Business</span> -->
																			</td>	
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">BANK WIRE DETAILS</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">Beneficiary Name: INVENTCO SOFTWARE PVT LTD</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">Bank Name: HDFC BANK LTD MUMBAI</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">Bank Account Number: XXXXXXXXXXXXXX</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">Swift Code: HDFCINBBXXX</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">Branch – Jaipur</span>
																			</td>		
																		</tr>
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Phone</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">@foreach($client as $value){{$value->client_mobile_number}}@endforeach</span>
																			</td>	
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Phone</span>
																				<span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">+91 2589745658</span>
																			</td>	
																		</tr>
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">EMAIL ADDRESS</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">@foreach($client as $value){{$value->email}}@endforeach</span>
																			</td>	
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">EMAIL ADDRESS</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">jiten@inventcolabs.com</span>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td colspan="2" style="padding-top: 20px;">
																	<table style="border-collapse: collapse;width: 100%;">
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">CREATION DATE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->created_at }}</span>
																			</td>	
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">DOCUMENT NUMBER</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->invoice_number }}</span>
																			</td>	
																			
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">MEMO</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->memo }}</span>
																			</td>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">MILESTONE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->milestone}}</span>
																			</td>
																		</tr>
																		<tr>
																			<td  colspan="2" style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">PROJECT TITLE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->project_name}}</span>
																			</td>	
																			<td  colspan="2" style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
																				<span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">REFERENCE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{$data->reference}}</span>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</tbody>
														<tfoot>
															<tr>
																<td colspan="2" style="padding-top: 20px;">
																	<table style="border-collapse: collapse;width: 100%;">
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
																				<span style="font-size: 14px;display: inline-block;font-weight: bold;">STATUS:</span> <span style="font-size: 15px;">USD {{$data->status==0?'Pending':'Active'}}</span>
																			</td>	
																		</tr>

																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
																				<span style="font-size: 14px;display: inline-block;font-weight: bold;">TOTAL:</span> <span style="font-size: 15px;">USD {{$data->total_amount}}</span>
																			</td>	
																		</tr>
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
																				<span style="font-size: 14px;display: inline-block;font-weight: bold;">TAXES OR TRANSACTION CHARGES:</span> <span style="font-size: 15px;">NA</span>
																			</td>	
																		</tr>
																		<tr>
																			<td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
																				<span style="font-size: 14px;display: inline-block;font-weight: bold;">GRAND TOTAL:</span> <span style="font-size: 15px;">USD {{$data->total_amount}}</span>
																			</td>	
																		</tr>
																	</table>
																</td>
																
															</tr>
															<tr>
																
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
