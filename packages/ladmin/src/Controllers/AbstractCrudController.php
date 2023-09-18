<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LowB\Ladmin\Contracts\Controllers\CrudControllerInterface;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Fields\Show\ShowField;

class AbstractCrudController extends Controller implements CrudControllerInterface
{
    public Crud|null $crud = null;
    public int $paginate = 24;

    public function init(Crud $crud)
    {
        $this->crud = $crud;
    }

    public function showFields()
    {
        $showFields = [];
        foreach ($this->crud->getColumns() as $col) {
            /** @var \Doctrine\DBAL\Schema\Column $col */
            // ArrayType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\ArrayType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // AsciiStringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\AsciiStringType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // BigIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BigIntType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // BinaryType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BinaryType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // BlobType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BlobType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // BooleanType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BooleanType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // ConversionException
            if ($col->getType() instanceof \Doctrine\DBAL\Types\ConversionException) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DateImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateImmutableType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DateIntervalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateIntervalType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DateTimeTzImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzImmutableType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DateTimeTzType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DateType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // DecimalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DecimalType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // FloatType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\FloatType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // GuidType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\GuidType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // IntegerType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\IntegerType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // JsonType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\JsonType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // ObjectType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\ObjectType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // PhpDateTimeMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpDateTimeMappingType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // PhpIntegerMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpIntegerMappingType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // SimpleArrayType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SimpleArrayType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // SmallIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SmallIntType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // StringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\StringType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // TextType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TextType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // TimeImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeImmutableType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // TimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // VarDateTimeImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeImmutableType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // VarDateTimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeType) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // Types
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Types) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $showFields[] = ShowField::column($col->getName());
                continue;
            }
        }
        return $showFields;
    }

    public function show(Request $request): View
    {
        $fields = $this->showFields();
        $items = $this->crud->getQuery()->paginate($this->paginate);
        return view('ladmin::crud.show', [
            'items' => $items,
            'fields' => $fields
        ]);
    }

    public function detail(Request $request): View
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.detail', [
            'item' => $item
        ]);
    }

    public function editor(Request $request): View
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        if (!$item) {
            abort(404);
        }
        return view('ladmin::crud.editor', [
            'item' => $item
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        return redirect('/');
    }

    public function update(Request $request): RedirectResponse
    {
        return redirect('/');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $item = $this->crud->getQuery()->where($this->crud->getPrimaryKey(), $request->primaryKey)->first();
        $item->delete();
        return redirect()->route(Ladmin::crud()->getShowRouteName());
    }
}
