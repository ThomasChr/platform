<?php declare(strict_types=1);

namespace Shopware\Core\Content\Product\SalesChannel\Sorting;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void                      add(ProductSortingEntity $entity)
 * @method void                      set(string $key, ProductSortingEntity $entity)
 * @method ProductSortingEntity[]    getIterator()
 * @method ProductSortingEntity[]    getElements()
 * @method ProductSortingEntity|null get(string $key)
 * @method ProductSortingEntity|null first()
 * @method ProductSortingEntity|null last()
 */
class ProductSortingCollection extends EntityCollection
{
    public function sortByKeyArray(array $keys): void
    {
        $sorted = [];

        foreach ($keys as $key) {
            $sorting = $this->getByKey($key);
            if ($sorting !== null) {
                $sorted[$sorting->getId()] = $this->elements[$sorting->getId()];
            }
        }

        $this->elements = $sorted;
    }

    public function getByKey(string $key): ?ProductSortingEntity
    {
        return $this->filterByProperty('key', $key)->first();
    }

    public function getApiAlias(): string
    {
        return 'product_sorting_collection';
    }

    protected function getExpectedClass(): string
    {
        return ProductSortingEntity::class;
    }
}