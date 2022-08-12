<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\CommentController;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Filesystem\Filesystem;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::where('status', '!=', '-1')->get();
        return view('be.product.index', ['products' => $products]);
    }
    public function create()
    {
        return view('be.product.create');
    }
    public function postCreate(ProductRequest $request)
    {
        $product = $request->all();
        $p = new Product($product);

        $nameExist = Product::where('name', '=', $product['name'])->first();
        if ($nameExist !== null) {
            return redirect()->route('be.product.create')->with('nameErr', 'Name already exists, please rename')->withInput();
        }

        // check cover
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imageName = $file->getClientOriginalName();
            $imageName = str_replace(
                pathinfo($imageName, PATHINFO_FILENAME),
                uniqid(),
                $imageName
            );

            $file->move('images/' . $p->type . '/' . $p->folder, $imageName);
        } else {
            $imageName = null;
        }
        $p->cover = $imageName;

        // check images
        if ($request->hasfile('images') && isset($p->cover)) {
            $i = 0;
            foreach ($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $name = str_replace(
                    pathinfo($name, PATHINFO_FILENAME),
                    pathinfo($imageName, PATHINFO_FILENAME) . '-' . $i++,
                    $name
                );

                $image->move('images/' . $p->type . '/' . $p->folder, $name);
                $data[] = $name;
            }
            $p->images = json_encode($data);
        } else {
            $p->images = null;
        }
        // end images


        $p->save();
        return redirect()->route('be.product');
    }

    //  ------------- Update ------------------------
    public function update($id)
    {
        $p = Product::find($id);
        $images = json_decode($p->images);
        return view('be.product.update', ['p' => $p, 'images' => $images]);
    }
    public function postUpdate(ProductRequest $request, $id)
    {
        $product = $request->all();
        $p = Product::find($id);

        $nameExist = Product::where([
            ['id', '!=', $id],
            ['name', '=', $product['name']],
        ])->first();
        if ($nameExist !== null) {
            return redirect()->route('be.product.update', ['id' => $id])->with('nameErr', 'Inputed name already exists, please rename or keep the old one')->withInput();
        }

        $oldPath = 'images/' . $p->type . '/' . $p->folder . '/';
        $newPath = 'images/' . $product['type'] . '/' . $product['folder'] . '/';

        // check cover
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imageName = $file->getClientOriginalName();
            $imageName = str_replace(
                pathinfo($imageName, PATHINFO_FILENAME),
                uniqid(),
                $imageName
            );

            $imagePath = public_path($oldPath . $p->cover);
            if (isset($p->folder)) {
                File::delete($imagePath);
            }
            $file->move($newPath, $imageName);
        } elseif (isset($p->cover)) {
            $imageName = $p->cover;
            if (!File::exists($newPath)) {
                File::makeDirectory($newPath, 0777, true, true);
            }
            rename(
                $oldPath . '/' . $imageName,
                $newPath . '/' . $imageName
            );
        } else {
            $imageName = null;
        }

        // check images
        if (
            $request->hasfile('images') &&
            (isset($p->cover) || $request->hasFile('cover'))
        ) {
            // delete previous images
            if (isset($p->images)) {
                $images = json_decode($p->images);
                if (isset($p->folder)) {
                    foreach ($images as $image) {
                        File::delete(public_path($oldPath . $image));
                    }
                }
            }

            $i = 0;
            foreach ($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $name = str_replace(
                    pathinfo($name, PATHINFO_FILENAME),
                    pathinfo($imageName, PATHINFO_FILENAME) . '-' . $i++,
                    $name
                );

                $image->move($newPath, $name);
                $data[] = $name;
            }
            $p->images = json_encode($data);
        } else {
            $images = json_decode($p->images);
            if (!File::exists($newPath)) {
                File::makeDirectory($newPath . '/', 0777, true, true);
            }
            if (isset($images)) {
                $i = 0;
                foreach ($images as $image) {
                    $name = str_replace(
                        pathinfo($image, PATHINFO_FILENAME),
                        pathinfo($imageName, PATHINFO_FILENAME) . '-' . $i++,
                        $image
                    );
                    rename(
                        $oldPath . '/' . $image,
                        $newPath . '/' . $name
                    );
                    $data[] = $name;
                }
                $p->images = json_encode($data);
            }
        }

        if (isset($p->folder) && isset($p->type)) {
            $this->clearFolder($p->type . '/' . $p->folder);
        }
        // end images

        $p->cover = $imageName;

        $p->name = $product['name'];
        $p->price = $product['price'];
        $p->description = $product['description'];
        $p->release = $product['release'];
        $p->quantity = $product['quantity'];
        $p->status = $product['status'];
        $p->type = $product['type'];
        $p->tags = $product['tags'];
        $p->folder = $product['folder'];

        $p->save();
        return redirect()->route('be.product.details', ['id' => $p->id]);
    }

    public function delete($id)
    {
        $p = Product::find($id);
        $path = 'images/' . $p->type . '/' . $p->folder . '/';
        if (isset($p->cover)) {
            File::delete($path . $p->cover);
        }
        if (isset($p->images)) {
            $images = json_decode($p->images);
            foreach ($images as $image) {
                if (isset($p->folder)) {
                    File::delete($path . $image);
                }
            }
        }
        if (isset($p->type) && isset($p->folder)) {
            $this->clearFolder($p->type . '/' . $p->folder); // clear folder when empty
        }

        $p->price = null;
        $p->quantity = null;
        $p->status = -1;
        $p->tags = null;
        $p->cover = null;
        $p->images = null;
        $p->save();
        return redirect()->route('be.product');
    }

    public function hidden()
    {
        $products = Product::where('status', '-1')->get();
        return view('be.product.hidden', compact('products'));
    }
    public function details($id)
    {
        $p = Product::find($id);
        $images = (isset($p->images)) ? json_decode($p->images) : null;
        return view('be.product.details', compact('p', 'images'));
    }


    public function clearFolder($path)
    {
        $FileSystem = new Filesystem();
        // Target directory.
        $directory = 'images/' . $path . '/';
        if ($FileSystem->exists($directory)) {
            // Get all files in this directory.
            $files = $FileSystem->files($directory);
            // Check if directory is empty.
            if (empty($files)) {
                // Yes, delete the directory.
                $FileSystem->deleteDirectory($directory);
            }
        }
    }
}
