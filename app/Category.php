<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// lekcija: 28 - Application - 228.Creating model and migration for categories.mp4, model za rad sa 'categories' tabelom , kategorije se dodeljuju postovima u 'posts' tabeli koja ima kolonu category_id
class Category extends Model{
  protected $fillable = ['name']; // kolona name ce biti slobodna za popunjavanje od strane usera 
}
