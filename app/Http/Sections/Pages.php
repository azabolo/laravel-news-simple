<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;

/**
 * Class Pages
 *
 * @property \App\Models\Page $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Pages extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Новости';

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fa fa-file');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', 'ID')
                ->setWidth(50),
            AdminColumn::link('category.name', 'Категория')
                ->setSearchable(false),
            AdminColumn::link('title', 'Анонс новости')
                ->setSearchCallback(function ($column, $query, $search) {
                    return $query
                        ->orWhere('title', 'like', '%' . $search . '%')
                        ->orWhere('text', 'like', '%' . $search . '%');
                }),
            \AdminColumnEditable::checkbox('is_posted', 'Опубликовано'),
            AdminColumn::text('datetime_post', 'Дата публикации',)
                ->setWidth('160px')
                ->setOrderable(function ($query, $direction) {
                    $query->orderBy('datetime_post', $direction);
                })
                ->setSearchable(false),
        ];

        return AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(25)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center');
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $form = AdminForm::card()
            ->addBody([
                AdminFormElement::select('category_id', 'Категория', Category::class)
                    ->setDisplay('name')
                    ->required(),
                AdminFormElement::text('title', 'Анонс новости')
                    ->required(),
                AdminFormElement::datetime('datetime_post', 'Дата публикации')
                    ->required(),
                AdminFormElement::checkbox('is_posted', 'Опубликовано')
                    ->setHelpText('Поставьте галочку, когда новость готова к публикации'),
                AdminFormElement::wysiwyg('text', 'Текст новости')
                    ->required()
            ]);

        $form->getButtons()->setButtons([
            'save' => new Save(),
            'save_and_close' => new SaveAndClose(),
            'save_and_create' => new SaveAndCreate(),
            'cancel' => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        return $this->onEdit(null, $payload);
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
