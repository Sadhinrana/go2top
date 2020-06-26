<?php

namespace App\Http\Controllers\reseller;

use App\CmsSettingGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CmsSettingGeneralsTableSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;

class CmsSettingGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check_setting = CmsSettingGeneral::where('reseller_id', Auth::user()->id)->get();
        if (count($check_setting) != 16) :
            CmsSettingGeneral::where('reseller_id', Auth::user()->id)->delete();
            $cmsSettingSeed = new CmsSettingGeneralsTableSeeder();
            $cmsSettingSeed->run();
        endif; 
        
        $cms_setting = CmsSettingGeneral::where('reseller_id', Auth::user()->id)->get();
        $get_timezone = self::getTimezone();
        $get_enable = self::getEnable();
        $get_currency = self::getCurrencyFormat();
        $get_rate_format = self::getRateFormat();
        $get_ticket = self::getTicketPerUser();
        return view('reseller.settings.general.create-edit',compact('cms_setting','get_timezone','get_enable','get_currency','get_rate_format','get_ticket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);

        try{
            $prevImage = CmsSettingGeneral::where('reseller_id', $id)->get();  
            $logo_image = '';
            if ($request->file('logo') !='') {

                if (!empty($prevImage) && $prevImage[0]->value !="") {
                    if (File::exists('uploads/reseller/logo/'.$prevImage[0]->value)) {
                        File::delete('uploads/reseller/logo/'.$prevImage[0]->value);
                    }
                } 

                $dir = public_path('uploads/reseller/logo/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }

                $file = $request->file('logo');
                $logo_image = 'logo-'.Auth::user()->id.'-'.time().'.'.$file->getClientOriginalExtension();

                $logo_move = Image::make($file->getRealPath())->resize(200, 80);
                $logo_move->save('uploads/reseller/logo/'.$logo_image,80);
                CmsSettingGeneral::where('keyword', 'logo')->where('reseller_id', $id)->update(['value' => $logo_image]);
            }

            $favicon_image = '';
            if ($request->file('favicon') !='') {

                if (!empty($prevImage) && $prevImage[1]->value !="") {
                    if (File::exists('uploads/reseller/favicon/'.$prevImage[1]->value)) {
                        File::delete('uploads/reseller/favicon/'.$prevImage[1]->value);
                    }
                } 

                $dir = public_path('uploads/reseller/favicon/');
                if(!file_exists( $dir ) && !is_dir( $dir ))
                {
                    mkdir($dir,0777,true);
                }

                $file = $request->file('favicon');
                $favicon_image = 'favicon-'.Auth::user()->id.'-'.time().'.'.$file->getClientOriginalExtension();

                $logo_move = Image::make($file->getRealPath())->resize(16, 16);
                $logo_move->save('uploads/reseller/favicon/'.$favicon_image,16);
                CmsSettingGeneral::where('keyword', 'favicon')->where('reseller_id', $id)->update(['value' => $favicon_image]);
            }

            if (!empty($request->general)) :
                foreach ($request->general as $value) :
                    $update = [ 'value' => $value['post_value'] ];
                    CmsSettingGeneral::where('keyword', $value['key'])->where('reseller_id', $id)->update($update);
                endforeach;
            endif;

            return redirect()->back()->withSuccess('Setting update successfully.');
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cms_setting = CmsSettingGeneral::find($id);
        $url = 'uploads/reseller/logo/';
        $image_type = 'Logo';

        if ($request->type == 2) {
            $url = 'uploads/reseller/favicon/';
            $image_type = 'Favicon';
        }

        try{
            if (!empty($cms_setting) && $cms_setting['value'] !="") {
                if (File::exists($url.$cms_setting['value'])) {
                    File::delete($url.$cms_setting['value']);
                }
                CmsSettingGeneral::where('id', $id)->update(['value' => '']);
            } 
            return redirect()->back()->withSuccess($image_type.' Image deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function getTimezone()
    {
        $arr = [
            '-43200' => '(UTC -12:00) Baker/Howland Island',
            '-39600' => '(UTC -11:00) Niue',
            '-36000' => '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti',
            '-34200' => '(UTC -9:30) Marquesas Islands',
            '-32400' => '(UTC -9:00) Alaska Standard Time, Gambier Islands',
            '-28800' => '(UTC -8:00) Pacific Standard Time, Clipperton Island',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-21600' => '(UTC -6:00) Central Standard Time',
            '-18000' => '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time',
            '-16200' => '(UTC -4:30) Venezuelan Standard Time',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-25200' => '(UTC -7:00) Mountain Standard Time',
            '-14400' => '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time',
            '-12600 ' => '(UTC -3:30) Newfoundland Standard Time',
            '-10800 ' => '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay',
            '-7200 ' => '(UTC -2:00) South Georgia/South Sandwich Islands',
            '-3600 ' => '(UTC -1:00) Azores, Cape Verde Islands',
            '0' => '(UTC) Greenwich Mean Time, Western European Time',
            '3600' => '(UTC +1:00) Central European Time, West Africa Time',
            '7200' => '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time',
            '10800' => '(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time',
            '12600' => '(UTC +3:30) Iran Standard Time',
            '14400' => '(UTC +4:00) Azerbaijan Standard Time, Samara Time',
            '16200' => '(UTC +4:30) Afghanistan',
            '18000' => '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time',
            '19800' => '(UTC +5:30) Indian Standard Time, Sri Lanka Time',
            '20700' => '(UTC +5:45) Nepal Time',
            '21600' => '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time',
            '23400' => '(UTC +6:30) Cocos Islands, Myanmar',
            '25200' => '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam',
            '28800' => '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time',
            '31500' => '(UTC +8:45) Australian Central Western Standard Time',
            '32400' => '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time',
            '34200' => '(UTC +9:30) Australian Central Standard Time',
            '36000' => '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time',
            '37800' => '(UTC +10:30) Lord Howe Island',
            '39600' => '(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu',
            '41400' => '(UTC +11:30) Norfolk Island',
            '43200' => '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time',
            '45900' => '(UTC +12:45) Chatham Islands Standard Time',
            '46800' => '(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga',
            '50400' => '(UTC +14:00) Line Island'
        ];
        return $arr;
    }

    private function getEnable(){
        $arr = [
            '0' => 'Disabled',
            '1' => 'Enabled',
        ];
        return $arr;
    }

    private function getCurrencyFormat()
    {
        $arr = [
            '0' => '1000.00',
            '1' => '1000,00',
            '2' => '1,000.12',
            '3' => '1,000',
        ];
        return $arr;
    }

    private function getRateFormat(){
        $arr = [
            '0' => 'Ones (1)',
            '1' => 'Hundredth (1.11)',
            '2' => 'Thousandth (1.111)',
        ];
        return $arr;
    }

    private function getTicketPerUser()
    {
        $arr = [];
        for ($i = 0; $i <= 9; $i++) :
            if ($i == 0) :
                $arr[$i] = 'Unlimited';
            else:
                $arr[$i] = $i.' tickets';
            endif;
        endfor;
        return $arr;
    }

}
