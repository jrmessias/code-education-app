<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 20:03
 */

namespace JrMessias\Presenters;

use JrMessias\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}