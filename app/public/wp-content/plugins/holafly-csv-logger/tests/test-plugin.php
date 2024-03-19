<?php
/**
 * Class PluginTest
 *
 * This class contains unit tests for the export_order_to_csv function.
 */
class PluginTest extends WP_UnitTestCase {
	public function orderDataIsExportedCorrectly(): void {
		$order = $this->createMock( WC_Order::class );
		$order->method( 'get_data' )->willReturn( [
			'date_created' => new DateTime(),
			'total'        => 100.0,
			'billing'      => [ 'email' => 'test@example.com' ]
		] );

		$this->assertTrue( export_order_to_csv( $order ) );

		$file   = fopen( wp_upload_dir()['basedir'] . '/orders.csv', 'r' );
		$header = fgetcsv( $file );
		$data   = fgetcsv( $file );
		fclose( $file );

		$this->assertEquals( [ 'Creation Date', 'Total Value', 'Buyer Email' ], $header );
		$this->assertEquals( [
			$order->get_data()['date_created']->date( 'Y-m-d H:i:s' ),
			$order->get_data()['total'],
			$order->get_data()['billing']['email']
		], $data );
	}

	public function orderDataIsNotExportedIfOrderDataIsEmpty(): void {
		$order = $this->createMock( WC_Order::class );
		$order->method( 'get_data' )->willReturn( [] );

		$this->assertTrue( export_order_to_csv( $order ) );

		$file   = fopen( wp_upload_dir()['basedir'] . '/orders.csv', 'r' );
		$header = fgetcsv( $file );
		$data   = fgetcsv( $file );
		fclose( $file );

		$this->assertEquals( [ 'Creation Date', 'Total Value', 'Buyer Email' ], $header );
		$this->assertFalse( $data );
	}

	public function orderDataIsNotExportedIfOrderIsNull(): void {
		$this->expectException( TypeError::class );

		export_order_to_csv( null );
	}
}
