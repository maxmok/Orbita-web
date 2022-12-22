SELECT distinct 
	dp.id_person,
	(select value from attribute_value where id_data_portion = dp.id and id_attribute = 6 limit 1) as fio, 
	(select value from attribute_value where id_data_portion = dp.id and id_attribute = 12 limit 1) as birth_date,
	(select value from attribute_value where id_data_portion = dp.id and id_attribute = 1 order by start_date_value limit 1 ) as inn,
	(select value from attribute_value where id_data_portion = dp.id and id_attribute = 7 order by start_date_value limit 1) as tabn,
	(select value from attribute_value where id_data_portion = dp.id and id_attribute = 40 order by start_date_value limit 1) as dolzhnost
	
FROM Attribute_Value av 
	LEFT JOIN Data_Portion dp ON av.id_data_Portion = dp.id 
WHERE av.id_attribute in (6) and dp.id_person in (1232,75267, 456)