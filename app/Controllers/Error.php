<?

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use App\Models\KategoriModel;
use App\Models\CustomeModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
class Error extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Hmmm Sepertinya ada salah...',
        ];

        return view('errors/error-page', $data);
    }
}