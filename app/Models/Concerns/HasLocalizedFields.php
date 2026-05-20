<?php

namespace App\Models\Concerns;

/// Mix-in for models that store `{field}_ar` and `{field}_en` columns
/// alongside an older single-language column.
///
/// Lookup order in `localized($field)`:
///   1. `{field}_{currentLocale}`  (e.g. `name_ar` when app locale is `ar`)
///   2. `{field}_en`               (English fallback)
///   3. `{field}`                  (legacy single-language column)
///   4. null
///
/// The trait does NOT override Eloquent attribute access — accessing the
/// raw columns from admin forms still works exactly like before.
trait HasLocalizedFields
{
    public function localized(string $field, ?string $locale = null): mixed
    {
        $locale ??= app()->getLocale();

        foreach (["{$field}_{$locale}", "{$field}_en", $field] as $col) {
            $value = $this->getAttribute($col);
            if ($value === null) {
                continue;
            }
            if (is_string($value) && trim($value) === '') {
                continue;
            }
            return $value;
        }

        return null;
    }
}
