<div class="card-body invoice_template">
<div class="table-responsive">
    <table class="table" style="width:680px;margin:0px auto;background-color:#f5f5f5">
        <tbody>
            <tr>
                <td>
                    <table style="max-width:100%;padding:40px 40px 20px 40px;margin:0px auto;color: black;background-color:#fff;font-family: arial,sans-serif;border-collapse: collapse;font-size: 12px;">
                        <tbody>
                            <tr>
                                <td style="padding: 15px; width: 100%">
                                    <table style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <table style="width:100%">
                                                        <td><b>Invoice ID : </b>{{!empty($data->invoice_number) ? $data->invoice_number : 'NA'}}</td>
                                                        <td style="text-align: right;"><img src="{{ asset('assets/images/logo.png') }}" style="max-width: 150px;"></td>
                                                    </table>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                                <td style="padding-top: 20px;">
                                                    <table style="border-collapse: collapse;width: 100%;">
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">TO</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 14px;">{{!empty($data->client->client_name) ? $data->client->client_name : 'NA' }}</span>
                                                                <!-- <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">It Business</span> -->
                                                            </td>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;font-size: 13px;">FROM</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">{{ !empty($data->getBank->beneficiary_name) ? $data->getBank->beneficiary_name : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Address</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 12px; max-width:180px">{{ !empty($data->client->client_address) ? $data->client->client_address : 'NA' }}
                                                                <?php /* @foreach($client as $value){{$value->client_address}}@endforeach */ ?></span>
                                                            </td>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">BANK WIRE DETAILS</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">Beneficiary Name: {{ !empty($data->getBank->beneficiary_name) ? $data->getBank->beneficiary_name : 'NA' }}</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">Bank Name: {{ !empty($data->getBank->bank_name) ? $data->getBank->bank_name : 'NA' }}</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">Bank Account Number: {{ !empty($data->getBank->bank_accout_number) ? $data->getBank->bank_accout_number : 'NA' }}</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">Swift Code: {{ !empty($data->getBank->swift_code) ? $data->getBank->swift_code : 'NA' }}</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 13px;">Branch : {{ !empty($data->getBank->branch) ? $data->getBank->branch : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Phone</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->client->client_mobile_number) ? $data->client->client_mobile_number : 'NA' }}
                                                                <?php /* @foreach($client as $value){{$value->client_mobile_number}}@endforeach */ ?></span>
                                                            </td>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Phone</span>
                                                                <span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->company_phone) ? $data->company_phone : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">EMAIL ADDRESS</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->client->email) ? $data->client->email : 'NA' }}
                                                                <?php /* @foreach($client as $value){{$value->email}}@endforeach */ ?></span>
                                                            </td>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">EMAIL ADDRESS</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->company_email) ? $data->company_email : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 20px;">
                                                    <table style="border-collapse: collapse;width: 100%;">
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top; ">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">CREATION DATE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ date("Y, M d H:i A", strtotime($data->created_at)) }}</span>
                                                            </td>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top; ">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">DOCUMENT NUMBER</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->invoice_number) ? $data->invoice_number : 'NA' }}</span>
                                                            </td>

                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">MILESTONE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->milestone) ? $data->milestone : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding: 8px;border: 1px solid #ddd;vertical-align: top; ">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">Project Name</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->project_name) ? $data->project_name : 'NA' }}</span>
                                                            </td>
                                                            <td colspan="2" style="padding: 8px;border: 1px solid #ddd;vertical-align: top; ">
                                                                <span style="font-weight: bold;font-size: 14px;display: inline-block;width: 100%;text-transform: uppercase;margin-bottom: 7px;">REFERENCE</span><span style="display: inline-block;width: 100%;margin-bottom: 5px;font-size: 15px;">{{ !empty($data->reference) ? $data->reference : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="padding-top: 20px;">
                                                    <table style="border-collapse: collapse;width: 100%;">
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
                                                                <span style="font-size: 14px;display: inline-block;font-weight: bold;">STATUS:</span> <span style="font-size: 15px;">

                                                                <?php
                                                                    $status = 'Pending';
                                                                    if($data->status== 1){
                                                                        $status = 'Active';
                                                                    }elseif($data->status== 2){
                                                                        $status = 'Received';
                                                                    }
                                                                ?>
                                                                
                                                                {{$status}}</span>
                                                            </td>
                                                        </tr>



                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
                                                                <span style="font-size: 14px;display: inline-block;font-weight: bold;">TOTAL:</span> <span style="font-size: 15px;">{!! !empty($data->currency) ? $data->currency : '' !!} {{ !empty($data->total_amount) ? $data->total_amount : 'NA' }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
                                                                <span style="font-size: 14px;display: inline-block;font-weight: bold;">TAXES OR TRANSACTION CHARGES:</span> <span style="font-size: 15px;">NA</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 8px;border: 1px solid #ddd;vertical-align: top;text-align: right;">
                                                                <span style="font-size: 14px;display: inline-block;font-weight: bold;">GRAND TOTAL:</span> <span style="font-size: 15px;">{!! !empty($data->currency) ? $data->currency : '' !!} {{ !empty($data->total_amount) ? $data->total_amount : 'NA' }} </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>

                                            </tr>
                                            <tr>

                                            </tr>
                                                                </tfoot>
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

