<?php

namespace App\Policies;

use App\Models\CategoriesOffers;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Admin can view any models.
     *
     * @param Admin $admin
     * @return void
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the Admin can view the model.
     *
     * @param Admin $admin
     * @param CategoriesOffers $offer
     * @return Response|bool
     */
    public function view($admin, CategoriesOffers $offer)
    {
        if($admin instanceof Admin){
            return $admin->id == $offer->admin_id;
        }
        return false;
    }

    /**
     * Determine whether the Admin can create models.
     *
     * @param Admin $admin
     * @return void
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the Admin can update the model.
     *
     * @param Admin $admin
     * @param CategoriesOffers $offer
     * @return void
     */
    public function update(Admin $admin, CategoriesOffers $offer)
    {
    }

    /**
     * Determine whether the Admin can delete the model.
     *
     * @param Admin $admin
     * @param CategoriesOffers $offer
     * @return void
     */
    public function delete(Admin $admin, CategoriesOffers $offer)
    {
        //
    }

    /**
     * Determine whether the Admin can restore the model.
     *
     * @param Admin $admin
     * @param CategoriesOffers $offer
     * @return void
     */
    public function restore(Admin $admin, CategoriesOffers $offer)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the model.
     *
     * @param Admin $admin
     * @param CategoriesOffers $offer
     * @return void
     */
    public function forceDelete(Admin $admin, CategoriesOffers $offer)
    {
        //
    }
}
