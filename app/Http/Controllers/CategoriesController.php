<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller {

    private $myCategories = [];

    public function __construct()
    {
        $this->myCategories = array(
            ['id' => 99999997, 'name' => "Breakfast", 'items' => '面包, 蛋糕, 荷包蛋, 烧饼, 饽饽, 油条, 馄饨, 火腿'],
            ['id' => 99999998, 'name' => "Lunch", 'items' => '盖浇饭, 砂锅, 大排档, 米线, 满汉全席, 西餐, 麻辣烫, 自助餐, 炒面, 快餐, 水果, 西北风, 馄饨, 火锅, 烧烤, 面'],
            ['id' => 99999999, 'name' => "Dinner", 'items' => '速冻水饺, 日本料理, 涮羊肉, 味千拉面, 肯德基, 面包, 扬州炒饭, 自助餐, 茶餐厅, 海底捞, 咖啡, 比萨, 麦当劳, 兰州拉面, 沙县小吃']
        );
    }

    /**
     * Api for angular frontend, provide user category list from database
     *
     * @return user's categories if logged in, or demo categories for guests
     */
    public function index()
    {
        if (Auth::guest())
        {
            return $this->myCategories;
        } else if (Auth::check())
        {
            $userCategories = Auth::user()->categories->toArray();
            if (!empty($userCategories))
            {
                foreach ($userCategories as $category)
                {
                    $categories[] = array('id' => $category['id'], 'name' => $category['name'], 'items' => $category['items']);
                }

                return $categories;
            }
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\CategoryRequest $request
     * @return Response
     */
    public function store(Requests\CategoryRequest $request)
    {

        if ($category = new Category($request->all()))
        {
            if (Auth::user()->categories()->save($category))
            {
                return $category->id;
            }
        }

        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        if (Auth::guest())
        {
            $categories = $this->myCategories;
            foreach ($categories as $category)
            {
                if ($category['id'] == $id)
                {
                    return $category;
                }
            }
        } else if (Auth::check())
        {
            return Category::find($id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $items = is_array($request->get('items')) ? implode(',', $request->get('items')) : $request->get('items');
        if ($category->update(['name' => $request->get('name'), 'items' => $items]))
        {
            return 'Your category has been updated successfully!';
        } else
        {
            return 'Oops...There were something wrong when processing update!';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->delete())
        {
            return 1;
        }

        return 0;
    }

}
