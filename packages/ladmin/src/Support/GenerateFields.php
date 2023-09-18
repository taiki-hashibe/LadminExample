<?php

namespace LowB\Ladmin\Support;

use LowB\Ladmin\Config\Facades\LadminConfig;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Fields\Detail\DetailField;
use LowB\Ladmin\Fields\Editor\EditorField;
use LowB\Ladmin\Fields\Editor\LongTextEditorField;
use LowB\Ladmin\Fields\Editor\NumberEditorField;
use LowB\Ladmin\Fields\Show\ShowField;
use LowB\Ladmin\Support\Facades\GenerateValidationRules;

class GenerateFields
{
    public function show(Crud $crud): array
    {
        $showFields = [];
        foreach ($crud->columns() as $col) {
            /** @var \Doctrine\DBAL\Schema\Column $col */
            if (in_array($col->getName(), LadminConfig::hiddenShow())) {
                continue;
            }
            // ArrayType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ArrayType) {
            //     $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // AsciiStringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\AsciiStringType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BigIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BigIntType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BinaryType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BinaryType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BlobType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BlobType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BooleanType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BooleanType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ConversionException
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ConversionException) {
            //     $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // DateImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateImmutableType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateIntervalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateIntervalType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzImmutableType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DecimalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DecimalType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // FloatType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\FloatType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // GuidType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\GuidType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // IntegerType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\IntegerType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // JsonType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\JsonType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ObjectType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ObjectType) {
            //     $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // PhpDateTimeMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpDateTimeMappingType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // PhpIntegerMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpIntegerMappingType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SimpleArrayType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SimpleArrayType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SmallIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SmallIntType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // StringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\StringType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TextType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TextType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeImmutableType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // VarDateTimeImmutableType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeImmutableType) {
            //     $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // VarDateTimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeType) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Types
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Types) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $showFields[] = ShowField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }
        }
        return $showFields;
    }

    public function detail(Crud $crud): array
    {
        $detailFields = [];
        foreach ($crud->columns() as $col) {
            /** @var \Doctrine\DBAL\Schema\Column $col */
            if (in_array($col->getName(), LadminConfig::hiddenDetail())) {
                continue;
            }
            // ArrayType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ArrayType) {
            //     $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // AsciiStringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\AsciiStringType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BigIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BigIntType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BinaryType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BinaryType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BlobType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BlobType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BooleanType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BooleanType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ConversionException
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ConversionException) {
            //     $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // DateImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateImmutableType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateIntervalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateIntervalType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzImmutableType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DecimalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DecimalType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // FloatType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\FloatType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // GuidType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\GuidType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // IntegerType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\IntegerType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // JsonType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\JsonType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ObjectType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ObjectType) {
            //     $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // PhpDateTimeMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpDateTimeMappingType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // PhpIntegerMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpIntegerMappingType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SimpleArrayType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SimpleArrayType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SmallIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SmallIntType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // StringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\StringType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TextType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TextType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeImmutableType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // VarDateTimeImmutableType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeImmutableType) {
            //     $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // VarDateTimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeType) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Types
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Types) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $detailFields[] = DetailField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }
        }
        return $detailFields;
    }

    public function editor(Crud $crud): array
    {
        $editorFields = [];
        foreach ($crud->columns() as $col) {
            /** @var \Doctrine\DBAL\Schema\Column $col */
            if (in_array($col->getName(), LadminConfig::hiddenEditor())) {
                continue;
            }
            // BigIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BigIntType) {
                $editorFields[] = NumberEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ArrayType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ArrayType) {
            //     $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // AsciiStringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\AsciiStringType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BinaryType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BinaryType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BlobType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BlobType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // BooleanType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\BooleanType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ConversionException
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ConversionException) {
            //     $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // DateImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateImmutableType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateIntervalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateIntervalType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzImmutableType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateTimeTzType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateTimeTzType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DateType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DateType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // DecimalType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\DecimalType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // FloatType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\FloatType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // GuidType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\GuidType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // IntegerType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\IntegerType) {
                $editorFields[] = NumberEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // JsonType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\JsonType) {
                $editorFields[] = LongTextEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // ObjectType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\ObjectType) {
            //     $editorFields[] = LongTextEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // PhpDateTimeMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpDateTimeMappingType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // PhpIntegerMappingType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\PhpIntegerMappingType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SimpleArrayType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SimpleArrayType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // SmallIntType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\SmallIntType) {
                $editorFields[] = NumberEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TextType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TextType) {
                $editorFields[] = LongTextEditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // StringType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\StringType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeImmutableType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeImmutableType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TimeType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // VarDateTimeImmutableType
            // if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeImmutableType) {
            //     $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
            //     continue;
            // }

            // VarDateTimeType
            if ($col->getType() instanceof \Doctrine\DBAL\Types\VarDateTimeType) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Types
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Types) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // Type
            if ($col->getType() instanceof \Doctrine\DBAL\Types\Type) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }

            // TypeRegistry
            if ($col->getType() instanceof \Doctrine\DBAL\Types\TypeRegistry) {
                $editorFields[] = EditorField::column($col->getName())->setValidation(GenerateValidationRules::generateColumn($col));
                continue;
            }
        }
        return $editorFields;
    }
}
