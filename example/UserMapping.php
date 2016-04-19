<?php

/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 7/02/16
 * Time: 17:33.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Example\Repository;

use DateTime;
use NilPortugues\Foundation\Infrastructure\Model\Repository\Sql\SqlMapping;

/**
 * Class UserMapping.
 */
class UserMapping extends SqlMapping
{
    /**
     * Name of the identity field in storage.
     *
     * @return string
     */
    public function identity()
    {
        return 'user_id';
    }

    /**
     * Returns the table name.
     *
     * @return string
     */
    public function name()
    {
        return 'users';
    }

    /**
     * Keys are object properties without property defined in identity(). Values its SQL column equivalents.
     *
     * @return array
     */
    public function map()
    {
        return [
            'username' => 'username',
            'alias' => 'public_username',
            'email' => 'email',
            'registeredOn' => 'created_at',
        ];
    }

    /**
     * @param User $object
     *
     * @return array
     */
    public function toArray($object)
    {
        return [
            'username' => $object->username(),
            'alias' => $object->alias(),
            'email' => $object->email(),
            'registeredOn' => $object->registeredOn()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function fromArray(array $data)
    {
        if (empty($data)) {
            return;
        }

        return new User(
            $data['user_id'],
            $data['username'],
            $data['public_username'],
            $data['email'],
            new DateTime($data['created_at'])
        );
    }
}
