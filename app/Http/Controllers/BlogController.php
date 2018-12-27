<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use App\SousCategory;
use App\Change;
use App\Productsimage;

use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    // afficher tous les produits
    public function getAllProduits(){
     
         $produits = Produit::all();
         //dd($produits);
         $this->getImagesProduits($produits);

         return ['produits' => $produits ];
    }

      // afficher tous les produits
      public function getImagesProduits(){
         
          $produitsImg = Productsimage::leftJoin('productsimages','productsimages.id_produits','=','produits.id')
          ->select('produits.*','productsimages.image_products')
          ->groupBy('produits.id')
          ->get();
          //dd($produits);
          return ['produitsImg' => $produitsImg ];
     }

    // rechercher produit par prix
    public function searchPrice($mini = null,$maxi = null){
     $min=(float)$mini;
     $max=(float)$maxi;
        // dd($min.' - '.$max);
         if ($min == null && $max == null) {
       //  dd('ifff  '.$min.' - '.$max);

                $produits = Produit::all();
      
          }
          elseif (!$min) {
        // dd('els ifff min '.$min.' - '.$max);

                $produits = Produit::where('price', '<=', $max)->get();

          }
          elseif (!$max) {
            //   dd('els ifff max  '.$min.' - '.$max);

                $produits = Produit::where('price', '>=', $min)->get();

          }
          elseif($max != null and $min != null){
         // dd('els   '.$min.' - '.$max);

          $produits = DB::table('produits')
                    ->whereBetween('price', [$min, $max])->get();
             //   $produits = Produit::whereBetween('price', [$min, $max])->get();
          }
        
                  //  dd($produits);
        return Response()->json(['produits' => $produits ]);
     }


// rechercher un produit par titre
     public function searchProduit($title){
        $produitsTitle = Produit::where('title','like','%'.$title.'%')->get();
      // dd($produits);
   
        return Response()->json(['produitsTitle' => $produitsTitle]);
     }


     // rechercher les sous categories
     public function searchCategory($id_category){
   
      $produitsCat=Produit::leftJoin('sous_categories', 'produits.id_sous_category', '=', 'sous_categories.id')
      ->where('sous_categories.id_category', '=', $id_category)
      ->get();

        return Response()->json(['produitsCat' => $produitsCat]);
     }


// rechercher les produits des sous categories
     public function searchSousCategory($id_sous_category){
        $produitsSsCat = Produit::where('id_sous_category',$id_sous_category)->get();
       //dd($produits);
   
        return Response()->json(['produitsSsCat' => $produitsSsCat]);
     }


       // rechercher les images fixee (changes)
    public function searchChange($id){
     $change = Change::find($id);

          dd($change);
     return Response()->json(['change' => $change ]);
  }
    
}
