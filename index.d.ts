export interface Province {
  id: string;
  province_code: string;
  name: string;
  short_name: string;
  code: string;
  place_type: string;
  country: string;
  created_at: string | null;
  updated_at: string | null;
}

export interface Ward {
  id: string;
  ward_code: string;
  name: string;
  province_code: string;
  created_at: string | null;
  updated_at: string | null;
}

export interface WardMapping {
  id: string;
  old_ward_code: string;
  old_ward_name: string;
  old_district_name: string;
  old_province_name: string;
  new_ward_code: string;
  new_ward_name: string;
  new_province_name: string;
  created_at: string;
  updated_at: string;
}

export interface DatabaseItem {
  type: string;
  name?: string;
  database?: string;
  data?: Province[] | Ward[] | WardMapping[];
  version?: string;
  comment?: string;
}

/**
 * Raw address database array
 */
declare const addressData: DatabaseItem[];
export = addressData;
