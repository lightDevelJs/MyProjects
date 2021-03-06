1. ������� ��� ���� � �������� ������ (id:627), ������� ��������� �� �������� ����� (id:789) � �������� ������ ������ (id: 89). 
� ������� �������� �������� �����, ������ � ������, � ����� ����� ����. ������� ������������� �� ������ ����.

SELECT houses.id, houses.house_number,  citys.title , streets.title, regions.title FROM streets, houses, citys, regions 
WHERE houses.region_id=89 AND houses.street_id=789 
AND houses.city_id=627 AND houses.street_id=streets.id AND houses.city_id=citys.id  AND houses.region_id=regions.id ORDER BY houses.house_number;

2. ������� ��� ��������� � �������� ������ (id: 627), �������� ������� ���������� �� ����� �˔. 
������������� ������� �� ���������� (priority; 1 � �������, 0 - ������) � �� �������� ������ ����������.
SELECT firms.id, firms.title,  firms.priority FROM firms WHERE firms.city_id=627 AND firms.title LIKE "�%" ORDER BY firms.priority<0, firms.title ;

3. ������� ����� ������� ���������� �������������� �������, � ������� ������������ ���������, ������������ �� ����� �̔.
SELECT  GROUP_CONCAT(DISTINCT firms.city_id) as `unique_cities` FROM firms WHERE  firms.title LIKE "�%"; 