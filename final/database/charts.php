<?php

/**
 *  Retorna o numero de utilizadores de cada tipo
 *
 * @return array com numero de utilizadores por tipo
 */
function getNumUsers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT role, COUNT(role) FROM users GROUP BY role");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 *  Retorna o lucro de pagamentos de um periodo de 6 meses
 *
 * @return array com lucro por mes
 */
function getProfit()
{
    //vou buscar meses
    global $conn;
    $stmt = $conn->prepare("select extract(month from payment_date)AS month,sum(value)  from payments where extract(year
                            from payment_date)=extract(year from now()) group by month order by month DESC limit 6;");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 *  Retorna o historico mais recente, com limite de 15 mensagens de historico
 *
 * @return array com historico
 */
function getHistory()
{
    global $conn;
    $stmt = $conn->prepare("SELECT payments.payment_date, payments.value, users.name, payments.payment_type FROM payments 
                            LEFT OUTER JOIN donatives ON (payments.id=donatives.id) LEFT OUTER JOIN mercha_purchases ON 
                            (payments.id=mercha_purchases.id) LEFT OUTER JOIN friend_events ON (friend_events.payment=payments.id)
                             LEFT OUTER JOIN users ON(users.id=donatives.friend OR users.id=friend_events.friend OR users.id = mercha_purchases.friend) 
                             order by payments.payment_date desc limit 15");
    $stmt->execute();
    return $stmt->fetchAll();
}




