<?php 
class Utilities{
    public function getPaging( $page, $total_rows, $records_per_page, $page_url): array {
        $paging_arr = [];

        $paging_arr['first'] = $page > 1 ? $page_url . 'page=1' : '';

        $total_pages = ceil($total_rows / $records_per_page);
        
        $paging_arr["pages"] = [];
        $page_count = 0;

        for($x = 1; $x <= $total_pages; $x++){
            $paging_arr["pages"][$page_count]["page"] = $x;
            $paging_arr["pages"][$page_count]["url"] = $page_url . 'page=' . $x ;
            $paging_arr["pages"][$page_count]["current_page"] = $x == $page ? "yes" : "no";
            $page_count++;
        }

        $paging_arr["last"] = $page < $total_pages ? $page_url . 'page=' . $total_pages : '';

        return $paging_arr;
    }
}